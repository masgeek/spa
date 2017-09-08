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
        $deviceToken = 'ed3Y-Vbz2-U:APA91bHAh0KkhWYdRlzl2ORBbihzBUITao5iJ-RUGwzns2bmRYumjTSYVauJq9ine31lMMDqxbdEGC9AZymLEWj0HEIPeaIf7MojbhMkIN63a8oURrNoQ63ldDcnz-wd9rrz-cCq02Gs';
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

       return $response->getStatusCode();
    }

}