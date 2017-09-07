<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $NOTIFICATION_ID
 * @property string $RECIPIENT
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RECIPIENT'], 'required'],
            [['RECIPIENT'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NOTIFICATION_ID' => 'Notification  ID',
            'RECIPIENT' => 'Recipient',
        ];
    }
}
