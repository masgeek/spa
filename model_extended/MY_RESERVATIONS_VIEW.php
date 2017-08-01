<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:08
 */

namespace app\model_extended;


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

    public function getPaymentInfo()
    {
        $data = MY_PAYMENTS_MODEL::findOne(['RESERVATION_ID' => $this->RESERVATION_ID]);

        return $data;
    }

}