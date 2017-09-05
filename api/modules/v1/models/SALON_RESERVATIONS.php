<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 05-Sep-17
 * Time: 11:46
 */

namespace app\api\modules\v1\models;


use app\models\VwSalonReservations;

class SALON_RESERVATIONS extends VwSalonReservations
{
    public static function GetReservationsCount($salon_id)
    {
        $count = self::find()
            ->where(['SALON_ID' => $salon_id])
            ->count('RESERVATION_ID');

        return $count != null ? $count : 0;
    }
}