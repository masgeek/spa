<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 3:46 PM
 */

namespace app\api\modules\v1\models;


use app\models\Reservations;

class RESERVATION_MODEL extends Reservations
{

	public function rules()
	{
		$rules = parent::rules();
		return $rules;
	}

	public function fields()
	{
		$fields = parent::fields();

		$fields['RESERVED_SERVICES'] = function ($model) {
			/* @var $model RESERVATION_MODEL */
			return $model->reservedServices;
		};
		//unset($fields['SERVICE_COST']);
		return $fields;
	}
}