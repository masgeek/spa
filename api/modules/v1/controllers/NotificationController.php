<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Sep-17
 * Time: 11:58
 */

namespace app\api\modules\v1\controllers;


use app\api\notifications\PUSH_NOTIFICATIONS;
use paragraph1\phpFCM\Recipient\Device;
use Yii;
use yii\rest\ActiveController;

class NotificationController extends ActiveController
{
    public $modelClass = 'app\api\modules\v1\models\NOTIFICATIONS_MODEL';

    public function actionPush()
    {
        $push = new PUSH_NOTIFICATIONS();
        $deviceToken = 'ed3Y-Vbz2-U:APA91bHAh0KkhWYdRlzl2ORBbihzBUITao5iJ-RUGwzns2bmRYumjTSYVauJq9ine31lMMDqxbdEGC9AZymLEWj0HEIPeaIf7MojbhMkIN63a8oURrNoQ63ldDcnz-wd9rrz-cCq02Gs';

        return $push->NotifyUser("Account Activated", 'Dear me your account has been activated', $deviceToken);
    }

    public function actionToken(){

    }
}