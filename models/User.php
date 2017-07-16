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
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
	public $id;
	public $username;
	public $password;
	public $authKey;
	public $accessToken;
	private static $users = [
		'100' => [
			'id' => '100',
			'username' => 'admin',
			'password' => 'admin',
			'authKey' => 'test100key',
			'accessToken' => '100-token',
		],
		'101' => [
			'id' => '101',
			'username' => 'demo',
			'password' => 'demo',
			'authKey' => 'test101key',
			'accessToken' => '101-token',
		],
	];

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
			[['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD'], 'required'],
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

	//Login identity

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		foreach (self::$users as $user) {
			if ($user['accessToken'] === $token) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username)
	{
		foreach (self::$users as $user) {
			if (strcasecmp($user['username'], $username) === 0) {
				return new static($user);
			}
		}

		return null;
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->authKey;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return $this->password === $password;
	}
}
