<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $ID
 * @property string $DEVICE_ID
 * @property int $USER_ID
 * @property string $DEVICE_TOKENS
 * @property string $LAST_UPDATE
 * @property string $DATE_CREATED
 *
 * @property User $uSER
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
            [['DEVICE_ID', 'USER_ID', 'DEVICE_TOKENS', 'LAST_UPDATE', 'DATE_CREATED'], 'required'],
            [['USER_ID'], 'integer'],
            [['DEVICE_TOKENS'], 'string'],
            [['LAST_UPDATE', 'DATE_CREATED'], 'safe'],
            [['DEVICE_ID'], 'string', 'max' => 50],
            [['DEVICE_ID', 'USER_ID'], 'unique', 'targetAttribute' => ['DEVICE_ID', 'USER_ID']],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DEVICE_ID' => 'Device  ID',
            'USER_ID' => 'User  ID',
            'DEVICE_TOKENS' => 'Device  Tokens',
            'LAST_UPDATE' => 'Last  Update',
            'DATE_CREATED' => 'Date  Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(User::className(), ['USER_ID' => 'USER_ID']);
    }
}
