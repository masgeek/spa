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

	public function actionLogin()
	{

	}

	public function actionRegister()
	{
		/* @var $request USER_MODEL */
		$message = [];

		$request = (object)Yii::$app->request->post();


		$user = new USER_MODEL();
		$user->setScenario(USER_MODEL::SCENARIO_CREATE);
		//assign the post data values
		$user->SURNAME = $request->SURNAME;
		$user->EMAIL = $request->EMAIL;
		$user->MOBILE_NO = $request->MOBILE_NO;
		$user->OTHER_NAMES = $request->OTHER_NAMES;
		$user->ACCOUNT_TYPE_ID = isset($request->ACCOUNT_TYPE_ID) ? $request->ACCOUNT_TYPE_ID : 1;

		//we will need to encrypt this password bit
		$user->PASSWORD = $request->PASSWORD;

		if ($user->validate()) {
			if ($user->save()) {
				$message = [
					'id' => $user->USER_ID,
					'password' => $user->PASSWORD
				];
			}
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