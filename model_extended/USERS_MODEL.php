<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 11:48
 */

namespace app\model_extended;


use app\api\modules\v1\models\SALON_MODEL;
use app\api\modules\v1\models\USER_MODEL;
use app\components\CUSTOM_HELPER;
use app\models\User;
use phpDocumentor\Reflection\Types\This;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

class USERS_MODEL extends User implements IdentityInterface
{

    //public $LOGIN_ID;
    //public $EMAIL_ADDRESS;
    public $ACCOUNT_AUTH_KEY;
    public $PASSWORD_RESET_TOKEN;

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return $token;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function getAuthKey()
    {
        return null;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        /* @var $userModel USER_MODEL */

        $account_found = null;
        //$userModel = UserProfile::findOne(['USER_NAME' => $username, 'EMAIL_ADDRESS'=>$username]);
        $userModel = USER_MODEL::find()
            ->select(['USER_ID', 'EMAIL'])//select only specific fields
            ->where(['EMAIL' => $username])
            ->one();
        if ($userModel != null) {
            $account_found = static::findOne(['USER_ID' => $userModel->USER_ID]);
        }
        return $account_found;
    }

    /**
     * Password validation during login
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return $this->PASSWORD === sha1($password);
    }

    public function setPassword($password)
    {
        $this->PASSWORD = Security::generatePasswordHash($password);
    }

    public function getPassword()
    {
        return $this->PASSWORD;
    }

    /**
     * Generates a password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->PASSWORD_RESET_TOKEN = null;
    }

    //fields to return common stuff
    public function getUsername()
    {
        return $this->SURNAME;
    }

    public function getFullNames()
    {
        return $this->SURNAME;
    }

    public function getEmailAddress()
    {
        return $this->EMAIL;
    }

    public function getUserType()
    {
        return $this->aCCOUNTTYPE->ACCOUNT_NAME;
    }

    public function getMySalons()
    {
        $my_salons = [];
        if ($this->aCCOUNTTYPE->ACCOUNT_NAME === CUSTOM_HELPER::SALON_ADMIN) {
            $my_salons = MY_SALONS::SalonList($this->USER_ID);
        }

        return $my_salons;
    }
}