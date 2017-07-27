<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_status".
 *
 * @property int $ACCOUNT_STATUS_ID
 * @property string $STATUS_NAME
 *
 * @property User[] $users
 */
class AccountStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS_NAME'], 'required'],
            [['STATUS_NAME'], 'string', 'max' => 11],
            [['STATUS_NAME'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCOUNT_STATUS_ID' => 'Account  Status  ID',
            'STATUS_NAME' => 'Status  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['ACCOUNT_STATUS' => 'ACCOUNT_STATUS_ID']);
    }
}
