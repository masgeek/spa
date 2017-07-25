<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 12:32
 */

namespace app\model_extended;


use app\models\Salon;
use yii\helpers\ArrayHelper;

class MY_SALONS extends Salon
{
    public static function GetOwnerSalons($owner_id)
    {
        $salons = MY_SALONS::find()
            ->where(['OWNER_ID' => $owner_id])
            ->asArray()
            ->all();

        return $salons;
    }

    public static function SalonDropdown($owner_id)
    {

        $arr = self::GetOwnerSalons($owner_id);

        $items = ArrayHelper::map($arr, 'SALON_ID', 'SALON_NAME');

        return $items;
    }
}