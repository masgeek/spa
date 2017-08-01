<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 14:57
 */

namespace app\model_extended;


use app\models\OfferedServices;
use app\models\Services;
use yii\helpers\ArrayHelper;

class MY_SERVICES extends OfferedServices
{

    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        $label['SERVICE_ID'] = 'Service Name';
        return $label;
    }

    public function rules()
    {
        $rules = parent::rules();

//['x', 'compare', 'compareValue' => 100, 'operator' => '>='],
        $rules[] = [['SERVICE_COST'], 'number', 'min' => 1];

        return $rules;
    }

    public static function GetSalonServices($salon_id)
    {
        $excl = [];
        $salons = self::find()
            ->select('SERVICE_ID')
            ->where(['SALON_ID' => $salon_id])
            ->asArray()
            ->all();

        foreach ($salons as $key => $sal) {
            $excl[] = $sal['SERVICE_ID'];
        }

        return $excl;
    }

    public static function SalonDropdown($salon_id, $new_record)
    {
        $excl_arr = [];
        if ($new_record) {
            $excl_arr = self::GetSalonServices($salon_id);
        }

        $services = Services::find()
            ->where(['NOT IN', 'SERVICE_ID', $excl_arr])
            ->asArray()
            ->all();


        $items = ArrayHelper::map($services, 'SERVICE_ID', 'SERVICE_NAME');

        return $items;
    }
}