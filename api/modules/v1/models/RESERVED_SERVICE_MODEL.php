<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/17/2017
 * Time: 4:05 PM
 */

namespace app\api\modules\v1\models;


use app\models\ReservedServices;

class RESERVED_SERVICE_MODEL extends ReservedServices
{
	public function rules()
	{
		$rules = parent::rules();

		return $rules;
	}
}