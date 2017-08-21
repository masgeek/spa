<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:08
 */

namespace app\model_extended;


use app\api\modules\v1\models\RESERVED_SERVICE_MODEL;
use app\models\VwMyReservations;

class MY_RESERVATIONS_VIEW extends VwMyReservations
{
	public $USER_ID;
	public $REMAINING_AMOUNT;

	public function getPrimaryKey($asArray = false)
	{
		return 'RESERVATION_ID';
	}

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['STATUS_ID'] = 'Reservation Status';
		$labels['RESERVER_ID'] = 'Reserved By';
		$labels['BOOKING_AMOUNT'] = 'Amount Paid';
		$labels['ACCOUNT_REF'] = 'Account Reference';

		return $labels;
	}

	public function getAmountToPay()
	{
		$amount_paid = MY_PAYMENTS_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('BOOKING_AMOUNT');

		return $amount_paid;
	}

	public function getBalance($total_cost = false)
	{
		$total = RESERVED_SERVICE_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('SERVICE_AMOUNT');

		$amount_paid = MY_PAYMENTS_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('BOOKING_AMOUNT');

		if ($total_cost) {
			return $total;
		} else {
			return ($total - $amount_paid);
		}
	}

	public static function MyReservationsArr($owner_id)
	{
		$data = self::find()
			->select('RESERVATION_ID')
			->where(['OWNER_ID' => $owner_id])
			->asArray()
			->all();


		$reservations = [];
		foreach ($data as $k => $v) {
			$reservations[] = $v['RESERVATION_ID'];
		}
		return $reservations;
	}
}