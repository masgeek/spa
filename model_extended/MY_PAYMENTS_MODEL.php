<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Aug-17
 * Time: 11:13
 */

namespace app\model_extended;


use app\models\Payments;

class MY_PAYMENTS_MODEL extends Payments
{
	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['STATUS_ID'] = 'Reservation Status';
		$labels['RESERVER_ID'] = 'Reserved By';
		$labels['BOOKING_AMOUNT'] = 'Amount Paid';
		$labels['FINAL_AMOUNT'] = 'Total Cost';
		$labels['ACCOUNT_REF'] = 'Account Reference';
		$labels['MPESA_REF'] = 'Mpesa Reference';

		return $labels;
	}
}