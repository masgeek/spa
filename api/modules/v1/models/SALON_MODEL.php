<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 8:39 PM
 */

namespace app\api\modules\v1\models;


use yii\filters\RateLimitInterface;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

class SALON_MODEL extends \app\models\Salon
{

    const SCENARIO_CREATE = 'create';

    public function rules()
    {
        $rules = parent::rules();
        return $rules;
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        //$scenarios[self::SCENARIO_CREATE] = ['Name', 'Last_Name', 'Email'];
        return $scenarios;
    }

    /**
     * @return array
     */
    public function fields()
    {
        /* @var $model SALON_MODEL */
        $fields = parent::fields();

        $fields['RESERVATIONS'] = function ($model) {
            $reservationcount = SALON_RESERVATIONS::find()
                ->select(['SALON_RESERVATONS'])
                ->where(['SALON_ID' => $model->SALON_ID])
                ->one();

            return $reservationcount != null ? $reservationcount->SALON_RESERVATONS : 0;
        };
        return $fields;
    }
}