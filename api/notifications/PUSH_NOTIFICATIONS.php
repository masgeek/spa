<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 08-Sep-17
 * Time: 11:41
 */

namespace app\api\notifications;

use paragraph1\phpFCM\Recipient\Device;
use Yii;

class PUSH_NOTIFICATIONS
{
    public function NotifyUser($msgTitle, $msgBody, $deviceToken)
    {
        if ($deviceToken == null) {
            return false;
        }

        $note = Yii::$app->fcm->createNotification($msgTitle, $msgBody);
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ff4081')
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