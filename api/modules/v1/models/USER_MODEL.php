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
	public function rules()
	{
		$rules = parent::rules();
		return $rules;
	}

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();

		return $labels;
	}

	public function fields()
	{
		$fields = parent::fields();

		$fields['ACCOUNT_TYPE'] = function ($model) {
			/* @var $model USER_MODEL */
			return $model->aCCOUNTTYPE->ACCOUNT_NAME;
		};
		unset($fields['PASSWORD']);
		return $fields;
	}
}