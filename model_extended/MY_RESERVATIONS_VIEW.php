<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:08
 */

namespace app\model_extended;


use app\api\modules\v1\models\PAYMENT_MODEL;
use app\api\modules\v1\models\RESERVATION_MODEL;
use app\api\modules\v1\models\RESERVED_SERVICE_MODEL;
use app\api\modules\v1\models\USER_MODEL;
use app\models\VwMyReservations;

class MY_RESERVATIONS_VIEW extends VwMyReservations
{
	public $USER_ID;
	public $REMAINING_AMOUNT;

	public function getPrimaryKey($asArray = false)
	{
		return 'RESERVATION_ID';
	}

	public function fields()
	{
		$fields = parent::fields();

		$fields['COMMENTS'] = function ($model) {
			return $model->COMMENTS == null ? 'NONE' : $model->COMMENTS;
		};

		$fields['CUSTOMER'] = function ($model) {
			$data = USER_MODEL::findOne($model->RESERVER_ID);
			return "{$data->SURNAME} {$data->OTHER_NAMES}";
		};

		$fields['STATUS'] = function ($model) {
			$data = STATUS_MODEL::findOne($model->STATUS_ID);

			return $data == null ? 'PENDING' : strtoupper($data->STATUS_NAME);
		};

		$fields['AMOUNT_PAID'] = function ($model) {
			return PAYMENT_MODEL::getAmountPaid($model->RESERVATION_ID);
		};

		$fields['BALANCE'] = function ($model) {
			return PAYMENT_MODEL::GetBalance($model->RESERVATION_ID);
		};

		$fields['SERVICES'] = function ($model) {
			$query = RESERVED_SERVICE_MODEL::find()
				->where(['RESERVATION_ID' => $model->RESERVATION_ID])
				->all();

			return $query;
		};
		return $fields;
	}

	//////
	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['STATUS_ID'] = 'Reservation Status';
		$labels['RESERVER_ID'] = 'Reserved By';
		$labels['BOOKING_AMOUNT'] = 'Amount Paid';
		$labels['ACCOUNT_REF'] = 'Account Reference';

		return $labels;
	}

	public function getAmountPaid()
	{
		$amount_paid = MY_PAYMENTS_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('BOOKING_AMOUNT');

		return $amount_paid;
	}

	public function getBalance($total_cost = false)
	{
		/*$total = RESERVED_SERVICE_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('SERVICE_AMOUNT');*/
		$total = MY_RESERVATIONS::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('TOTAL_COST');

		$amount_paid = MY_PAYMENTS_MODEL::find()
			->where(['RESERVATION_ID' => $this->RESERVATION_ID])
			->sum('BOOKING_AMOUNT');

		if ($total_cost) {
			return $total;
		} else {
			return (($total) - ($amount_paid));
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