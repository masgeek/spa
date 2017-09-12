<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Sep-17
 * Time: 11:58
 */

namespace app\api\modules\v1\controllers;


use app\api\modules\v1\models\NOTIFICATIONS_MODEL;
use app\api\notifications\PUSH_NOTIFICATIONS;
use paragraph1\phpFCM\Recipient\Device;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class NotificationController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\NOTIFICATIONS_MODEL';

    public function actionPush()
    {
        $push = new PUSH_NOTIFICATIONS();
        return $push->NotifyUser("Account Activated", 'Your account has been activated', 2);
    }

    public function actionToken()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('Please use POST');
        }

        $request = (object)Yii::$app->request->post();
        $device_id = $request->DEVICE_ID;
        $user_id = $request->USER_ID;
        $device_tokens = $request->DEVICE_TOKENS;

        //first check if the record exists
        $record_exists = NOTIFICATIONS_MODEL::find()
            ->where(['DEVICE_ID' => $device_id])
            ->andWhere(['USER_ID' => $user_id])
            ->one();

        if ($record_exists == null) {
            $model = new NOTIFICATIONS_MODEL();
            $model->DEVICE_ID = $device_id;
        } else {
            $model = $record_exists;
        }

        $model->DEVICE_TOKENS = $device_tokens;
        $model->USER_ID = $user_id;

        if ($model->save() && $model->validate()) {
            return $model;
        } else {
            return $model->getErrors();
        }
    }
}