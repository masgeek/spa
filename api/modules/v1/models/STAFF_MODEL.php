<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/26/2017
 * Time: 4:44 PM
 */

namespace app\api\modules\v1\models;


use app\models\Staff;

class STAFF_MODEL extends Staff
{
	public function rules()
	{
		$rules = parent::rules();
		$rules[] = [['STAFF_TEL', 'STAFF_NAME'], 'required'];

		return $rules;
	}

	public function fields()
	{
		$fields = parent::fields();
		$fields['STAFF_NAME'] = function ($model) {
			/* @var $model $this */
			return "{$model->STAFF_NAME} ({$model->STAFF_TEL})";
		};

		$fields['SALON_NAME'] = function ($model) {
			/* @var $model $this */
			return $model->sALON->SALON_NAME;
		};
		return $fields;
	}
}