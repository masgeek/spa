<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\OFFERED_SERVICE_MODEL;

use app\api\modules\v1\models\SALON_MODEL;
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
		unset($actions['update']);
		unset($actions['create']);
		return $actions;
	}

	public function actionAdd()
	{
		$message = [];
		if (!Yii::$app->request->isPost) {
			throw new BadRequestHttpException('Please use POST');
		}
		$model = new SALON_MODEL();
		$request = Yii::$app->request->post();
		$salonArr = ['SALON_MODEL' => $request];
		if ($model->load($salonArr)) {
			if ($model->save() && $model->validate()) {

			} else {
				$errors = $model->getErrors();
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

	public function actionSalonServices($id)
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
}