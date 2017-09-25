<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 9/25/2017
 * Time: 9:51 PM
 */

namespace app\api\modules\v1\models;


use app\model_extended\MY_RESERVATIONS_VIEW;

class ALL_SALON_PAYMENTS extends MY_RESERVATIONS_VIEW
{
	public function fields()
	{
		$fields = parent::fields();

		$fields['SERVICES'] = function ($model) {
			$query = RESERVED_SERVICE_MODEL::find()
				->where(['RESERVATION_ID' => $model->RESERVATION_ID])
				->all();

			return $query;
		};
		return $fields;
	}
}