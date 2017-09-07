<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Sep-17
 * Time: 11:58
 */

namespace app\api\modules\v1\controllers;


use Yii;
use bryglen\apnsgcm\ApnsGcm;
use yii\rest\ActiveController;

class NotificationController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\NOTIFICATIONS_MODEL';

    public function actionPush()
    {
        $push_tokens = 8;
        $message = 9;

        /* @var $apnsGcm ApnsGcm */
        $apnsGcm = Yii::$app->apnsGcm;
        $resp = $apnsGcm->send(ApnsGcm::TYPE_GCM, $push_tokens, $message,
            [
                'customerProperty' => 1
            ],
            [
                'timeToLive' => 3
            ]);

        return $resp;
    }

}