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

		$fields['COMMENTS'] = function ($model) {
			if ($model->COMMENTS == null || strlen($model->COMMENTS) <= 2) {
				return 'N/A';
			}
			return $model->COMMENTS;
		};

		$fields['CUSTOMER_NAME'] = function ($model) {
			/* @var $model $this */
			$data = $model->rESERVATION->uSER;
			return "{$data->SURNAME} {$data->OTHER_NAMES}";
		};

        $fields['CUSTOMER_PHONE'] = function ($model) {
            /* @var $model $this */
            $data = $model->rESERVATION->uSER;
            return $data->MOBILE;
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

        return $amount_paid != null ? $amount_paid : 0;
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