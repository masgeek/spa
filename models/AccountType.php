<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_type".
 *
 * @property int $ACCOUNT_TYPE_ID
 * @property string $ACCOUNT_NAME
 *
 * @property User[] $users
 */
class AccountType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCOUNT_NAME'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCOUNT_TYPE_ID' => 'Account  Type  ID',
            'ACCOUNT_NAME' => 'Account  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['ACCOUNT_TYPE_ID' => 'ACCOUNT_TYPE_ID']);
    }
}
