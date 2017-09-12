<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Sep-17
 * Time: 12:04
 */

namespace app\api\modules\v1\models;


use app\models\Notifications;
use yii\db\Expression;
class NOTIFICATIONS_MODEL extends Notifications
{
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->LAST_UPDATE = new Expression('NOW');
            return true;
        }
        return false;
    }
}