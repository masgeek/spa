<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/21/2017
 * Time: 4:22 PM
 */

namespace app\api\modules\v1\models;


use app\models\VwMyReservedServices;

class MY_RESERVATIONS extends VwMyReservedServices
{
	public function fields()
	{
		$fields = parent::fields();
		$fields['SERVICES_RESERVED'] = function ($model) {
			/* @var $model RESERVED_SERVICE_MODEL */
			return RESERVED_SERVICE_MODEL::find()->where(['RESERVATION_ID' => $model->RESERVATION_ID])->count();
		};
		return $fields;
	}
}