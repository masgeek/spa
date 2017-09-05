<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 3:45 PM
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\SALON_MODEL;
use app\components\CUSTOM_HELPER;
use app\model_extended\MY_RESERVATIONS_VIEW;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

use app\api\modules\v1\models\MY_RESERVATIONS;
use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;
use app\api\modules\v1\models\RESERVED_SERVICE_MODEL;
use app\api\modules\v1\models\USER_MODEL;
use app\api\modules\v1\models\RESERVATION_MODEL;

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

	public function actionPending($id)
	{
		return $this->GetFilteredReservations($id, null);
	}

	public function actionConfirmed($id)
	{
		return $this->GetFilteredReservations($id, 1);
	}

	public function actionCancelled($id)
	{
		return $this->GetFilteredReservations($id, 2);
	}

	public function actionAddService($id)
	{

		$message = [];

		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$reservation = RESERVATION_MODEL::findOne($id); //check to see if the reservation exists
		$reserved_service = new RESERVED_SERVICE_MODEL();
		$request = Yii::$app->request->post();

		$add_post = ['RESERVED_SERVICE_MODEL' => $request];
		$services = Yii::$app->request->post('SELECTED_SERVICES');//isset($request->SELECTED_SERVICES) ? $request->SELECTED_SERVICES : [];

		foreach ($services as $key => $offered_service_id) {
			$reserved_service->isNewRecord = true;
			if ($reserved_service->load($add_post)) {
				$reserved_service->SERVICE_AMOUNT = Yii::$app->request->post('SERVICE_COST');
				$reserved_service->RESERVATION_ID = $id;
				$reserved_service->OFFERED_SERVICE_ID = $offered_service_id;

				if ($reserved_service->validate() && $reserved_service->save()) {
					$message = [$reserved_service];
					$this->UpdateTotalCost($reserved_service->RESERVATION_ID); //update the total
				} else {
					foreach ($reserved_service->getErrors() as $key => $error) {
						$message[] = [
							'field' => $key,
							'message' => $error[0]
						];
					}
				}
			}
		}
		return $message;

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
		$reservation->TOTAL_COST = isset($request->TOTAL_COST) ? $request->TOTAL_COST : 0;
		$reservation->ACCOUNT_REF = CUSTOM_HELPER::GenerateRandomRef();

		$reservation_date_raw = $reservation->RESERVATION_DATE = isset($request->RESERVATION_DATE) ? $request->RESERVATION_DATE : null;
		$reservation_time = isset($request->RESERVATION_TIME) ? $request->RESERVATION_TIME : null;
		//convert string to date format
		$DateTime = \DateTime::createFromFormat('Y-m-d', $reservation_date_raw);
		$reservation_date = $DateTime->format('Y-m-d');

		$services = isset($request->SELECTED_SERVICES) ? $request->SELECTED_SERVICES : [];
		$transaction = $db->beginTransaction();

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
				$reserved_services->RESERVATION_TIME = $reservation_time;
				$reserved_services->RESERVATION_DATE = $reservation_date;
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
			$this->UpdateTotalCost($reservation->RESERVATION_ID);
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

	public function actionMyReservations($id)
	{
		//get reservations made by the user
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}
		$query = MY_RESERVATIONS::find()->where(['USER_ID' => $id]);

		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 100,
			]
		]);

		return $provider;
	}

	public function actionReservedServices($id)
	{
		//get reservations made by the user
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}
		$query = RESERVED_SERVICE_MODEL::find()
			->where(['RESERVATION_ID' => $id])
			->all();

		return $query;
	}

	public function actionConfirmedReservations($id)
	{
		$status = 1;
		//get reservations made by the user
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}
		$query = MY_RESERVATIONS::find()
			->where(['USER_ID' => $id])
			->andWhere(['STATUS_ID' => $status]);

		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 100,
			]
		]);

		return $provider;
	}

	public function actionMyServices($id)
	{
		//get reservations made by the user
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}
		$query = RESERVED_SERVICE_MODEL::find()->where(['RESERVATION_ID' => $id]);

		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 20,
			]
		]);

		return $provider;
	}

	public function actionConfirm()
	{
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$request = (object)Yii::$app->request->post();

		$reservation_id = $request->RESERVATION_ID;
		$comments = $request->COMMENTS;

		$model = RESERVATION_MODEL::findOne($reservation_id);
		$model->COMMENTS = $comments;

		$model->STATUS_ID = 1;  //flag as confirmed
		if (!$model->save() && !$model->validate()) {
			$model = ['message' => 'Unable to confirm reservation please contact the Adminstrator'];
		}
		return $model;
	}

	public function actionCancel()
	{
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$request = (object)Yii::$app->request->post();

		$reservation_id = $request->RESERVATION_ID;
		$comments = $request->COMMENTS;

		$model = RESERVATION_MODEL::findOne($reservation_id);
		$model->COMMENTS = $comments;
		$model->STATUS_ID = 2;  //flag as confirmed

		if (!$model->save() && !$model->validate()) {
			$model = ['message' => 'Unable to cancel reservation please contact the Adminstrator'];
		}
		return $model;
	}

	/**
	 * Update the final cost
	 * @param $reservation_id
	 */
	private function UpdateTotalCost($reservation_id)
	{
		$raw_total = RESERVED_SERVICE_MODEL::find()
			->select(['SERVICE_AMOUNT'])
			->where(['RESERVATION_ID' => $reservation_id])->sum('SERVICE_AMOUNT');
		$sum_total = (float)$raw_total;
		$booking_total = $sum_total * 0.5; //50% of total

		RESERVATION_MODEL::updateAll([
			'TOTAL_COST' => $sum_total,
			'BOOKING_AMOUNT' => $booking_total
		], "RESERVATION_ID = $reservation_id");
	}

	private function GetFilteredReservations($salon_id, $status_id)
	{
		$reservations = MY_RESERVATIONS_VIEW::find()
			//->where(['SALON_ID' => $salon_id])
			//->andWhere(['STATUS_ID' => $status_id])
			->all(); //we will iterate to get the customer name
		return $reservations;
	}
}