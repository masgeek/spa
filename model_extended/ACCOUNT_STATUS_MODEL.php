<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 27-Jul-17
 * Time: 11:01
 */

namespace app\model_extended;


use app\models\AccountStatus;
use app\models\AccountType;
use yii\helpers\ArrayHelper;

class ACCOUNT_STATUS_MODEL extends AccountStatus
{
    public static function GetStatusArr()
    {
        $salons = self::find()
            ->asArray()
            ->all();

        return $salons;
    }

    public static function StatusDropdown()
    {

        $arr = self::GetStatusArr();

        $items = ArrayHelper::map($arr, 'ACCOUNT_STATUS_ID', 'STATUS_NAME');

        return $items;
    }

    public static function GetTypeArr()
    {
        $salons = AccountType::find()
            ->asArray()
            ->all();

        return $salons;
    }

    public static function TypeDropdown()
    {

        $arr = self::GetTypeArr();

        $items = ArrayHelper::map($arr, 'ACCOUNT_TYPE_ID', 'ACCOUNT_NAME');

        return $items;
    }
}