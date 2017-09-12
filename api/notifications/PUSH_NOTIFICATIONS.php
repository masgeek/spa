<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 08-Sep-17
 * Time: 11:41
 */

namespace app\api\notifications;

use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use understeam\fcm\Client;
use Yii;

class PUSH_NOTIFICATIONS
{
    /**
     * @param string $msgTitle
     * @param string $msgBody
     * @param array $deviceToken
     * @return bool|int
     */
    public function NotifyUser($msgTitle, $msgBody, array $deviceToken)
    {
        $deviceTokens = [];
        $push = Yii::$app->fcm;

        $note = $push->createNotification($msgTitle, $msgBody);
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ff4081')
            ->setBadge(1);

        /* @var $push Client */
        if ($deviceToken == null) {
            return false;
        }

        $deviceToken = 'ctHXIFy0J7s:APA91bFtaaSUCiN1UhCXX436cDJQz21S7wb7vnL48UDjmxSfQbvaTquIjM0us7CBcqT2QB1R_lLtHTFpVlVmmGLjqKzHjQi_xmyjaD4axOj4jqyblppnwQGtiEw7KsHk0fkyuh-yKv8Y';
        if (is_array($deviceToken)) {
            foreach ($deviceToken as $key => $tokens) {
                $deviceTokens[] = $tokens['DEVICE_TOKENS'];
            }
        } else {
            $deviceTokens = [$deviceToken];
        }
        $message = $push->createMessage($deviceTokens);
        //$message->addRecipient(new Device($token));
        $message->setNotification($note);
        $response = $push->send($message);

        return $response->getStatusCode();
    }
}