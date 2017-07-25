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
    
    public function getPrimaryKey($asArray = false)
    {
        return 'RESERVATION_ID';
    }

}