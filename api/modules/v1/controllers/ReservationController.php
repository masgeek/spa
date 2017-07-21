<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 3:45 PM
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;
use app\api\modules\v1\models\RESERVED_SERVICE_MODEL;
use app\api\modules\v1\models\USER_MODEL;
use Psr\Log\NullLogger;
use Yii;
use app\api\modules\v1\models\RESERVATION_MODEL;
use yii\db\Expression;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class ReservationController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\RESERVATION_MODEL';

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['update']);
		return $actions;
	}

	public function actionReserve()
	{
		/* @var $request RESERVATION_MODEL */
		$message = [];
		$db = Yii::$app->db;

		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$request = (object)Yii::$app->request->post();

		$reservation = new RESERVATION_MODEL();
		$reserved_services = new RESERVED_SERVICE_MODEL();

		//$reservation->setScenario(RESERVATION_MODEL::SCENARIO_CREATE);
		//assign the post data values
		$reservation->USER_ID = isset($request->USER_ID) ? $request->USER_ID : null;
		$reservation->RESERVATION_DATE = isset($request->RESERVATION_DATE) ? $request->RESERVATION_DATE : null;
		//$reservation->RESERVATION_TIME = isset($request->RESERVATION_TIME) ? $request->RESERVATION_TIME : new Expression('NOW()');
		$reservation->TOTAL_COST = isset($request->TOTAL_COST) ? $request->TOTAL_COST : 0;

		$services = isset($request->SERVICES) ? $request->SERVICES : [];
		$transaction = $db->beginTransaction();
		$servicesTotal = [];
		if ($reservation->validate() && $reservation->save()) {
			//next save the selected services
			foreach ($services as $key => $offered_service_id) {
				/* @var $serviceObj OFFERED_SERVICE_MODEL */
				$serviceObj = OFFERED_SERVICE_MODEL::findOne($offered_service_id);
				$reserved_services->isNewRecord = true;
				$reserved_services->RESERVED_SERVICE_ID = null;
				$reserved_services->RESERVATION_ID = $reservation->RESERVATION_ID;
				$reserved_services->OFFERED_SERVICE_ID = $serviceObj->OFFERED_SERVICE_ID;
				$reserved_services->SERVICE_AMOUNT = $serviceObj->SERVICE_COST;
				$reserved_services->RESERVATION_TIME = isset($request->RESERVATION_TIME) ? $request->RESERVATION_TIME : new Expression('NOW()');
				$reserved_services->RESERVATION_DATE = isset($request->RESERVATION_DATE) ? $request->RESERVATION_DATE : null;

				$servicesTotal[] = $serviceObj->SERVICE_COST;
				//save the data
				if ($reserved_services->validate() && $reserved_services->save()) {
					$message = [$reservation];
				} else {
					$errors = $reserved_services->getErrors();
					foreach ($errors as $key => $error) {
						$message[] = [
							'field' => $key,
							'message' => $error[0]
						];
					}
					$transaction->rollback();
					return $message;
				}
			}
			$transaction->commit();
			//next do the total for the services
			RESERVATION_MODEL::updateAll(['TOTAL_COST' => array_sum($servicesTotal)], "RESERVATION_ID = $reservation->RESERVATION_ID");
		} else {
			$transaction->rollback();
			$errors = $reservation->getErrors();
			foreach ($errors as $key => $error) {
				$message[] = [
					'field' => $key,
					'message' => $error[0]
				];
			}
		}

		return $message;
	}

	public function actionUpdate($id)
	{
		/* @var $request USER_MODEL */
		$message = [];

		$user = USER_MODEL::findOne($id);
		$user->setScenario(USER_MODEL::SCENARIO_UPDATE);
		if (!Yii::$app->request->isPut) {
			throw new BadRequestHttpException('Please use PUT');
		}

		$request = (object)Yii::$app->request->bodyParams;
		$user->SURNAME = isset($request->SURNAME) ? $request->SURNAME : $user->SURNAME;
		$user->EMAIL = isset($request->EMAIL) ? $request->EMAIL : $user->EMAIL;
		$user->MOBILE_NO = isset($request->MOBILE_NO) ? $request->MOBILE_NO : $user->MOBILE_NO;
		$user->OTHER_NAMES = isset($request->OTHER_NAMES) ? $request->OTHER_NAMES : $user->OTHER_NAMES;

		if (!$user->validate() && !$user->save()) {
			$errors = $user->getErrors();
			foreach ($errors as $key => $error) {
				$message[] = [
					'field' => $key,
					'message' => $error[0]
				];
			}
		}

		return $message;
	}
}