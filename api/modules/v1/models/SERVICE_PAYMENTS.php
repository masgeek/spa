<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 11:25 AM
 */

namespace app\api\modules\v1\models;


use app\models\VwSalonPayments;

class SERVICE_PAYMENTS extends VwSalonPayments
{

    public function fields()
    {
        $fields = parent::fields();

        $fields['COMMENTS'] = function ($model) {
            if ($model->COMMENTS == null || strlen($model->COMMENTS) <= 2) {
                return 'N/A';
            }
            return $model->COMMENTS;
        };

        $fields['CUSTOMER_NAME'] = function ($model) {
            /* @var $model $this */
            $data = USER_MODEL::findOne($model->USER_ID);
            return "{$data->SURNAME} {$data->OTHER_NAMES}";
        };

        $fields['CUSTOMER_PHONE'] = function ($model) {
            /* @var $model $this */
            return USER_MODEL::findOne($model->USER_ID)->MOBILE_NO;
        };

        $fields['STATUS'] = function ($model) {
            /* @var $model SERVICE_PAYMENTS */
            return $model->STATUS != null ? $model->STATUS : 'PENDING';
        };

        $fields['SALON_TEL'] = function () {
            return '';
        };
        $fields['OWNER_ID'] = function () {
            return 0;
        };

        return $fields;
    }
}