<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;

use app\api\modules\v1\models\RESERVED_SERVICE_MODEL;
use app\api\modules\v1\models\SALON_MODEL;
use app\api\modules\v1\models\STAFF_MODEL;
use http\Exception\BadConversionException;
use Yii;
use yii\data\ActiveDataProvider;

use yii\rest\ActiveController;

use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;


class SalonController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\SALON_MODEL';

	public function actions()
	{
		$actions = parent::actions();
		//unset($actions['update']);
		unset($actions['create']);
		return $actions;
	}

	public function actionAdd()
	{
		$message = [];
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$salonModel = new SALON_MODEL();
		$request = Yii::$app->request->post();
		$salonArr = ['SALON_MODEL' => $request];
		if ($salonModel->load($salonArr)) {
			if ($salonModel->save() && $salonModel->validate()) {
				$message = [$salonModel];
			} else {
				$errors = $salonModel->getErrors();
				foreach ($errors as $key => $error) {
					$message[] = [
						'field' => $key,
						'message' => $error[0]
					];
				}
			}
		} else {
			throw new ServerErrorHttpException("Unable to process Salon Data");
		}
		return $message;


	}

	public function actionAddService($id)
	{
		$message = [];

		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}

		$request = Yii::$app->request->post();

		$salon = SALON_MODEL::findOne($id);

		$post_arr = ['OFFERED_SERVICE_MODEL' => $request];

		if ($salon === null) {
			$message[] = ['field' => 'Not found', 'message' => 'Salon Not found'];
		} else {

			$offered_service = new OFFERED_SERVICE_MODEL();

			if ($offered_service->load($post_arr)) {
				$offered_service->STATUS = 1; //set to active aas the default
				if ($offered_service->validate() && $offered_service->save()) {
					$message = [$offered_service];
				} else {
					$errors = $offered_service->getErrors();
					foreach ($errors as $key => $error) {
						$message[] = [
							'field' => $key,
							'message' => $error[0]
						];
					}
				}
			}
			return $message;
		}
	}

	public
	function actionSalonServices($id)
	{
		$message = [];
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}

		$query = OFFERED_SERVICE_MODEL::find()->where(['SALON_ID' => $id]);

		$provider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 100,
			],
			'sort' => [
				'defaultOrder' => [
					'SALON_ID' => SORT_DESC,
				]
			],
		]);

		return $provider;
	}

	public
	function actionMySalons($id)
	{
		if (!Yii::$app->request->isGet) {
			throw new BadRequestHttpException('Please use GET');
		}

		$mysalons = SALON_MODEL::find()->where(['OWNER_ID' => $id])->all();

		return $mysalons;
	}

	public function actionStaff($id)
	{
		//get the staff of the salon
		$staff = STAFF_MODEL::find()
			->where(['SALON_ID' => $id])
			->orderBy(['STAFF_NAME' => SORT_ASC])
			->all();

		return $staff;
	}

}