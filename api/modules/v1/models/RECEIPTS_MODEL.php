<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/23/2017
 * Time: 8:49 PM
 */

namespace app\api\modules\v1\models;


use app\models\VwPaymentReceipts;

class RECEIPTS_MODEL extends VwPaymentReceipts
{
	public function fields()
	{
		$fields = parent::fields();

		return $fields;
	}
}