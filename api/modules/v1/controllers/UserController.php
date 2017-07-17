<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\SERVICE_MODEL;
use app\api\modules\v1\models\USER_MODEL;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\rest\Controller;
use yii\web\Response;

class UserController extends ActiveController
{
	/**
	 * @var object
	 */
	public $modelClass = 'app\api\modules\v1\models\USER_MODEL';

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['update']);
		return $actions;
	}

	public function actionRegister()
	{
		$message = [];

		$request = Yii::$app->request->post();


		$user = new USER_MODEL();

		return $request;
		if ($user->validate()) {

		} else {
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

	public function actionUpdate($id)
	{
		//update the user
		return $id;
	}
}