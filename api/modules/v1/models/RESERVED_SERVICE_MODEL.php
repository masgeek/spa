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

	public function fields()
	{
		$fields = parent::fields();
		$fields['SERVICE_NAME'] = function ($model) {
			/* @var $model RESERVED_SERVICE_MODEL */
			return SERVICE_MODEL::findOne($model->OFFERED_SERVICE_ID);
		};

		$fields['SALON_NAME'] = function ($model) {
			/* @var $model RESERVED_SERVICE_MODEL */
			if ($model->oFFEREDSERVICE != null) {
				return $model->oFFEREDSERVICE->sALON;
			}
		};

		$fields['STAFF'] = function ($model) {
			/* @var $model RESERVED_SERVICE_MODEL */
			$staff = 0;//'Not Assigned';
			if ($model->sTAFF != null) {
				$staff = $model->sTAFF;
			}

			return $staff;
		};

		$fields['STATUS'] = function ($model) {
			/* @var $model RESERVED_SERVICE_MODEL */
			$status = 'Pending';
			if ($model->sTATUS != null) {
				$status = $model->sTATUS->STATUS_NAME;
			}
			return $status;
		};
		unset($fields['STAFF_ID']);
		unset($fields['STATUS_ID']);
		return $fields;
	}
}