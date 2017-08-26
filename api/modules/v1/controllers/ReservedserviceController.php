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

class ReservedserviceController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\RESERVED_SERVICE_MODEL';

	public function actionConfirm()
	{
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$request = (object)Yii::$app->request->post();

		$reserved_service_id = $request->RESERVED_SERVICE_ID;

		$model = RESERVED_SERVICE_MODEL::findOne($reserved_service_id);
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

		$reserved_service_id = $request->RESERVED_SERVICE_ID;

		$model = RESERVED_SERVICE_MODEL::findOne($reserved_service_id);
		$model->STATUS_ID = 2;  //flag as confirmed
		if (!$model->save() && !$model->validate()) {
			$model = ['message' => 'Unable to cancel reservation please contact the Adminstrator'];
		}
		return $model;
	}

	public function actionAssignStaff()
	{
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$request = (object)Yii::$app->request->post();
		$reservation_id = $request->RESERVED_SERVICE_ID;
		$staff_id = $request->STAFF_ID;

		$model = RESERVED_SERVICE_MODEL::findOne($reservation_id);
		return $model;
		$model->STAFF_ID = $staff_id;
		if (!$model->save() && !$model->validate()) {
			$model = ['message' => 'Unable to assign staff please contact the Adminstrator'];
		}
		return $model;
	}
}