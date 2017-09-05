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
	/*
	 * /*
			"ACCOUNT_REF": "86FB5",
			"PAYMENT_ID": 34,
			"RESERVATION_ID": 73,
			"BOOKING_AMOUNT": "174.00",
			"FINAL_AMOUNT": "580.00",
			"DATE_PAID": "2017-08-23",
			"PAYMENT_REF": "86FB5",
			"BALANCE": "406.00",
			"MPESA_REF": "hfjdjejejeje",
			"COMMENTS": "N/A",
			"STATUS": "CONFIRMED",
			"SALON_TEL": "0713196504",
			"OWNER_ID": 2,
			"PAYMENT_STATUS": 1,
			"SALON_NAME": "Sammy Spa"
	 */
	public function field()
	{
		$fields = parent::fields();

		$fields['COMMENTS'] = function ($model) {
			if ($model->COMMENTS == null || strlen($model->COMMENTS) <= 2) {
				return 'N/A';
			}
			return $model->COMMENTS;
		};

		$fields['CUSTOMER_NAME'] = function ($model) {
			/* @var $model $this */
			$data = $model->rESERVATION->uSER;
			return "{$data->SURNAME} {$data->OTHER_NAMES} ({$data->MOBILE_NO})";
		};

		$fields['STATUS'] = function ($model) {
			/* @var $model $this */
			return $model->pAYMENTSTATUS != null ? $model->pAYMENTSTATUS->STATUS: 'PENDING';
		};

		$fields['SALON_TEL'] = function () {
			return '';
		};
		$fields['OWNER_ID'] = function () {
			return 0;
		};
		return $fields;
	}

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['MPESA_REF'] = 'M-Pesa Reference Number';
		return $labels;
	}

	public function rules()
	{
		$rules = parent::rules();
		//$rules[] = [['PAYMENT_REF'], 'unique', 'message' => 'Payment reference {value}  has already been used'];
		$rules[] = [['MPESA_REF'], 'unique', 'message' => 'MPesa Payment reference {value}  has already been used'];
		$rules[] = [['MPESA_REF'], 'string', 'min' => 7];
		//$rules[] = [['RESERVATION_ID'], 'unique', 'message' => 'Payment for reservation {value}  has already been made, please update balance'];
		return $rules;
	}

    public static function getAmountPaid($reservation_id)
    {

        $amount_paid = self::find()
            ->where(['RESERVATION_ID' => $reservation_id])
            ->sum('BOOKING_AMOUNT');

        return $amount_paid;
    }

    public static function GetBalance($reservation_id,$total_cost = false)
    {
        /*$total = RESERVED_SERVICE_MODEL::find()
            ->where(['RESERVATION_ID' => $this->RESERVATION_ID])
            ->sum('SERVICE_AMOUNT');*/
        $total = MY_RESERVATIONS::find()
            ->where(['RESERVATION_ID' => $reservation_id])
            ->sum('TOTAL_COST');

        $amount_paid = self::find()
            ->where(['RESERVATION_ID' => $reservation_id])
            ->sum('BOOKING_AMOUNT');

        if ($total_cost) {
            return $total;
        } else {
            return (($total) - ($amount_paid));
        }
    }
}