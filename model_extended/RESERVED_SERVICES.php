<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:29
 */

namespace app\model_extended;


use app\models\ReservedServices;

class RESERVED_SERVICES extends ReservedServices
{
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['STAFF_ID'] = 'Assigned Staff';

        return $labels;
    }
}