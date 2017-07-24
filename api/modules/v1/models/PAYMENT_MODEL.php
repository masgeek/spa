<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/25/2017
 * Time: 12:54 AM
 */

namespace app\api\modules\v1\models;


use app\models\Payments;

class PAYMENT_MODEL extends Payments
{
	public function fields()
	{
		$fields = parent::fields();

		return $fields;
	}
}