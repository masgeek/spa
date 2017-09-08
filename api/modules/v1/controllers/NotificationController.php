<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Sep-17
 * Time: 11:58
 */

namespace app\api\modules\v1\controllers;


use paragraph1\phpFCM\Recipient\Device;
use Yii;
use yii\rest\ActiveController;

class NotificationController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\NOTIFICATIONS_MODEL';

    public function actionPush()
    {
        $deviceToken = 'cRH_Kd1Mn-4:APA91bGMOcRt35HFB05g37064EtZVYBMm1xNKTPiWq1naM-6uSJ0d-ScHdSgazddujGO78z3Tf--CFoKvVCgLL8X_XdyXyQYpsZ7MWh-jt1oTtzn_ImV5EIU_3jEE8v4UcDGG0oRjwl3';
        $note = Yii::$app->fcm->createNotification("test title", "testing body");
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = Yii::$app->fcm->createMessage();
        $message->addRecipient(new Device($deviceToken));
       // $message->addRecipient(new Topic('SPA'));
        $message->setNotification($note)
            ->setData(['someId' => 111]);

        $response = Yii::$app->fcm->send($message);

        var_dump($response->getStatusCode());
    }

}