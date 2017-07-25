<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:17
 */

namespace app\model_extended;


use app\models\Reservations;

class MY_RESERVATIONS extends Reservations
{
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['STATUS_ID'] = 'Booking Status';

        return $labels;
    }
}