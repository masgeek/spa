<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 4:41 PM
 */

namespace app\model_extended;


use app\models\VwSalonPayments;

class ALL_PAYMENTS extends VwSalonPayments
{
public function attributeLabels()
{
    $labels =  parent::attributeLabels();

    $labels['BOOKING_AMOUNT'] = 'Amount Collected';
    $labels['BALANCE'] = 'Amount To Be Paid';
    $labels['FINAL_AMOUNT'] = 'Projected Revenue';
    return $labels;
}
}