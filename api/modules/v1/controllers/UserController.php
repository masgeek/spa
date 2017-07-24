<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:47 PM
 */

namespace app\api\modules\v1\controllers;

use app\api\modules\v1\models\ACCOUNT_TYPE_MODEL;
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
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
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
        /* @var $request USER_MODEL */
        $message = [];

        //var_dump($_SERVER);
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = (object)Yii::$app->request->post();

        $email = $request->EMAIL;
        $password = sha1($request->PASSWORD);
        $user = USER_MODEL::findOne(['EMAIL' => $email, 'PASSWORD' => $password]);
        if ($user != null) {
            if ($user->ACCOUNT_STATUS === 1) {
                $message = $user;
                //let us tell the user login is a sucess and add session to shared preferences
            } else {
                $message = [
                    'status' => false,
                    'message' => 'Your account has been suspended, please contact the Administrator'
                ];
            }
        } else {
            $message = [
                'status' => false,
                'message' => 'Invalid Username/Password'
            ];
        }

        return $message;
    }

    public function actionRecover()
    {

    }

    public function actionRegister()
    {
        /* @var $request USER_MODEL */
        $message = [];

        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }
        $request = (object)Yii::$app->request->post();


        $user = new USER_MODEL();
        $user->setScenario(USER_MODEL::SCENARIO_CREATE);
        //assign the post data values
        $user->SURNAME = isset($request->SURNAME) ? $request->SURNAME : null;
        $user->EMAIL = isset($request->EMAIL) ? $request->EMAIL : null;
        $user->MOBILE_NO = isset($request->MOBILE_NO) ? $request->MOBILE_NO : null;
        $user->OTHER_NAMES = isset($request->OTHER_NAMES) ? $request->OTHER_NAMES : $user->OTHER_NAMES;
        $user->ACCOUNT_TYPE_ID = isset($request->ACCOUNT_TYPE_ID) ? $request->ACCOUNT_TYPE_ID : 1;
        //we will need to encrypt this password bit
        $user->PASSWORD = sha1($request->PASSWORD);

        if ($user->validate()) {
            if ($user->save()) {
                $message = [$user];
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
        /* @var $request USER_MODEL */
        $message = [];

        if (!Yii::$app->request->isPut) {
            throw new BadRequestHttpException('Please use PUT');
        }

        $user = USER_MODEL::findOne($id);
        if ($user == null) {
            throw new NotFoundHttpException('User not found', 5);
        }


        $user->setScenario(USER_MODEL::SCENARIO_UPDATE);
        $request = (object)Yii::$app->request->bodyParams;
        $user->SURNAME = isset($request->SURNAME) ? $request->SURNAME : $user->SURNAME;
        $user->EMAIL = isset($request->EMAIL) ? $request->EMAIL : $user->EMAIL;
        $user->MOBILE_NO = isset($request->MOBILE_NO) ? $request->MOBILE_NO : $user->MOBILE_NO;
        $user->OTHER_NAMES = isset($request->OTHER_NAMES) ? $request->OTHER_NAMES : $user->OTHER_NAMES;
        if (isset($request->CHANGE_PASSWORD)) {
            $user->PASSWORD = sha1($request->PASSWORD);
        }

        if ($user->validate() && $user->save()) {
            $message = $user;
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

    public function actionAccountType()
    {
        $accountTypes = ACCOUNT_TYPE_MODEL::find()
            ->where(['FOR_MOBILE' => 1])
            ->orderBy(['ACCOUNT_NAME' => SORT_ASC])
            ->all();

        return $accountTypes;
    }
}