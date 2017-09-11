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
	 * @param array  $deviceToken
	 * @return bool|int
	 */
	public function NotifyUser($msgTitle, $msgBody, array $deviceToken)
	{
		/* @var $push Client */
		if ($deviceToken == null) {
			return false;
		}

		if (is_array($deviceToken)) {
			$push = Yii::$app->fcm;

			foreach ($deviceToken as $key => $tokens) {
				$token = $tokens['DEVICE_TOKENS'];

			}
			$note = $push->createNotification($msgTitle, $msgBody);
			$note->setIcon('notification_icon_resource_name')
				->setColor('#ff4081')
				->setBadge(1);


			$message = $push->createMessage();
			$message->addRecipient(new Device($token));
			// $message->addRecipient(new Topic('SPA'));
			$message->setNotification($note);
			//->setData(['someId' => 111]);

			$response = Yii::$app->fcm->send($message);

			var_dump($response->getStatusCode());
			die;
			return $response->getStatusCode();
		}
		return false;
	}
}