<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 12:33 PM
 */

namespace app\api\modules\v1\models;


use app\models\User;

class USER_MODEL extends User
{
	public $CHANGE_PASSWORD;

	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';

	public function rules()
	{
		$rules = parent::rules();

		$rules[] = [['EMAIL'], 'unique', 'on' => [self::SCENARIO_CREATE,self::SCENARIO_UPDATE]];
		return $rules;
	}

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_CREATE] = ['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD', 'ACCOUNT_TYPE_ID', 'ACCOUNT_STATUS', 'ACCOUNT_TYPE_ID'];
		$scenarios[self::SCENARIO_UPDATE] = ['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD', 'ACCOUNT_TYPE_ID', 'ACCOUNT_TYPE_ID'];

		return $scenarios;
	}

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();

		return $labels;
	}

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->PASSWORD = sha1($this->PASSWORD); //hash the user password
			}
			if ($this->CHANGE_PASSWORD == 'true' || $this->CHANGE_PASSWORD == 1) { //when checkbox is checked to indicate password changed
				//it is in update mode check if password change was requested
				$this->PASSWORD = sha1($this->PASSWORD); //hash the user password
			}
			return true;
		}
		return false;
	}

	public function fields()
	{
		$fields = parent::fields();

		$fields['ACCOUNT_TYPE'] = function ($model) {
			/* @var $model USER_MODEL */
			return $model->aCCOUNTTYPE->ACCOUNT_NAME;
		};
		//unset($fields['PASSWORD']);
		return $fields;
	}
}