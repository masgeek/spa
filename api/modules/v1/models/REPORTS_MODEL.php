<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 01-Sep-17
 * Time: 12:47
 */

namespace app\api\modules\v1\models;


use app\models\Reports;
use yii\db\Expression;
use yii\helpers\Url;

class REPORTS_MODEL extends Reports
{

    public function fields()
    {
        $fields =  parent::fields();

        $fields['FILE_LINK'] = function($model){
            $absoluteBaseUrl = Url::base(true);
            $file_link = "{$absoluteBaseUrl}/{$model->REPORT_URL}";
            return $file_link;
        };

        return $fields;
    }

    public static function SaveReport($user_id, $file_name)
    {
        $resp = [
            0
        ];
        $model = new REPORTS_MODEL();
        $model->isNewRecord = true;

        $model->SALON_OWNER_ID = $user_id;
        $model->REPORT_URL = $file_name;
        $model->DATE_GENERATED = new Expression('NOW()');
        $model->STATUS = 'READY';

        if ($model->save()) {
            $resp = $model;
        }
        return $resp;
    }
}