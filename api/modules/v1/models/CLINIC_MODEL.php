<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 07-Jun-17
 * Time: 10:53
 */

namespace app\api\modules\v1\models;


use app\api\models\Clinics;

class CLINIC_MODEL extends Clinics
{
    public $REGION_NAME;

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'CLINIC_ID',
            //'REGION_ID',
            'CLINIC_NAME',
            'REGION_NAME' => function ($model) {
                /* @var $model REGION_MODEL */
                //we wil use the base model here so that we return only one result
                $data = REGION_MODEL::findOne(['REGION_ID' => $model->REGION_ID]);
                return $data->REGION_NAME;
            },
            'LAT',
            'LONG',
            'DATE_ADDED',
            // 'TIMESTAMP',
        ];
    }
}