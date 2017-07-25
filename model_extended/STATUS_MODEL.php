<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:13
 */

namespace app\model_extended;


use app\models\Status;
use yii\helpers\ArrayHelper;

class STATUS_MODEL extends Status
{

    public static function GetStatus(){
        $arr = self::find()->asArray()->all();

        $items = ArrayHelper::map($arr, 'STATUS_ID', 'STATUS_NAME');

        return $items;
    }
}