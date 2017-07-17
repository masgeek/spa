<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int            $USER_ID
 * @property string         $SURNAME
 * @property string         $OTHER_NAMES
 * @property string         $EMAIL
 * @property string         $MOBILE_NO
 * @property int            $ACCOUNT_STATUS
 * @property int            $ACCOUNT_TYPE_ID
 * @property string         $PASSWORD
 *
 * @property Reservations[] $reservations
 * @property AccountType    $aCCOUNTTYPE
 */
class User extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'user';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD', 'ACCOUNT_TYPE_ID'], 'required'],
			[['ACCOUNT_STATUS', 'ACCOUNT_TYPE_ID'], 'integer'],
			[['SURNAME', 'EMAIL'], 'string', 'max' => 70],
			[['OTHER_NAMES'], 'string', 'max' => 255],
			[['MOBILE_NO'], 'string', 'max' => 15],
			[['PASSWORD'], 'string', 'max' => 300],
			[['ACCOUNT_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AccountType::className(), 'targetAttribute' => ['ACCOUNT_TYPE_ID' => 'ACCOUNT_TYPE_ID']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'USER_ID' => 'User ID',
			'SURNAME' => 'Surname',
			'OTHER_NAMES' => 'Other Names',
			'EMAIL' => 'Email',
			'MOBILE_NO' => 'Mobile Number',
			'ACCOUNT_STATUS' => 'Account Status',
			'ACCOUNT_TYPE_ID' => 'Account Type',
			'PASSWORD' => 'Password',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getReservations()
	{
		return $this->hasMany(Reservations::className(), ['USER_ID' => 'USER_ID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getACCOUNTTYPE()
	{
		return $this->hasOne(AccountType::className(), ['ACCOUNT_TYPE_ID' => 'ACCOUNT_TYPE_ID']);
	}
}
