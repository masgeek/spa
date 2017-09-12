<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 08-Sep-17
 * Time: 11:41
 */

namespace app\api\notifications;

use app\api\modules\v1\models\NOTIFICATIONS_MODEL;
use understeam\fcm\Client;
use Yii;

class PUSH_NOTIFICATIONS
{
    private function GetUserDeviceTokens($user_id)
    {
        $deviceTokens = NOTIFICATIONS_MODEL::find()
            ->select(['DEVICE_TOKENS'])
            ->where(['USER_ID' => $user_id])
            ->asArray()
            ->all();

        return $deviceTokens;
    }

    /**
     * @param string $msgTitle
     * @param string $msgBody
     * @param int $userID
     * @return bool|int
     */
    public function NotifyUser($msgTitle, $msgBody, $userID)
    {
        /* @var $push Client */
        $deviceTokens = [];
        $push = Yii::$app->fcm;

        $note = $push->createNotification($msgTitle, $msgBody);
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ff4081')
            ->setBadge(1);

        $deviceToken = $this->GetUserDeviceTokens($userID);


        //$deviceToken = 'ctHXIFy0J7s:APA91bFtaaSUCiN1UhCXX436cDJQz21S7wb7vnL48UDjmxSfQbvaTquIjM0us7CBcqT2QB1R_lLtHTFpVlVmmGLjqKzHjQi_xmyjaD4axOj4jqyblppnwQGtiEw7KsHk0fkyuh-yKv8Y';
        if (is_array($deviceToken) && count($deviceToken) > 0) {
            foreach ($deviceToken as $key => $tokens) {
                $deviceTokens[] = $tokens['DEVICE_TOKENS'];
            }


            $message = $push->createMessage($deviceTokens);

            //$message->addRecipient(new Device($token));
            $message->setNotification($note);
            $response = $push->send($message);

            return $response->getStatusCode();
        }
        return false;
    }
}