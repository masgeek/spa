<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 24-Jul-17
 * Time: 10:07
 */

namespace app\api\modules\v1\models;


use app\models\AccountType;

class ACCOUNT_TYPE_MODEL extends AccountType
{
    public function fields()
    {
        $fields = parent::fields();
        return $fields;
    }
}