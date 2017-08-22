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

		return $fields;;
	}
}