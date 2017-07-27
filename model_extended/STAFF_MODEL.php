<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 12:31
 */

namespace app\model_extended;


use app\models\Staff;
use yii\helpers\ArrayHelper;

class STAFF_MODEL extends Staff
{
    public static function GetStaffArr($salon_id)
    {
        $salons = STAFF_MODEL::find()
            ->where(['SALON_ID' => $salon_id])
            ->asArray()
            ->all();

        return $salons;
    }

    public static function StaffDropdown($salon_id)
    {

        $arr = self::GetStaffArr($salon_id);

        $items = ArrayHelper::map($arr, 'STAFF_ID', 'STAFF_NAME');

        return $items;
    }
}