<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 9/25/2017
 * Time: 9:51 PM
 */

namespace app\api\modules\v1\models;


use app\model_extended\MY_PAYMENTS_MODEL;
use app\model_extended\MY_RESERVATIONS_VIEW;

class ALL_SALON_PAYMENTS extends MY_RESERVATIONS_VIEW
{
	public function fields()
	{
		$fields = parent::fields();
		$fields['PAYMENTS'] = function ($model) {
			$query = MY_PAYMENTS_MODEL::find()
				->where(['RESERVATION_ID' => $model->RESERVATION_ID])
				->all();
			return $query;
		};

		//unset($fields['SERVICES']);
		return $fields;
	}
}