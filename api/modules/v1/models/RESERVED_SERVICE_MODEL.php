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
		if (!$this->isNewRecord) {
			$fields['SERVICE_NAME'] = function ($model) {
				/* @var $model RESERVED_SERVICE_MODEL */
				return OFFERED_SERVICE_MODEL::findOne($model->OFFERED_SERVICE_ID)->sERVICE->SERVICE_NAME;
			};

			$fields['SALON_ID'] = function ($model) {
				/* @var $model RESERVED_SERVICE_MODEL */
				return $model->oFFEREDSERVICE != null ? $model->oFFEREDSERVICE->sALON->SALON_ID : 0;
			};

			$fields['SALON_NAME'] = function ($model) {
				/* @var $model RESERVED_SERVICE_MODEL */
				return $model->oFFEREDSERVICE != null ? $model->oFFEREDSERVICE->sALON->SALON_NAME : 'N/A';
			};

			$fields['STAFF'] = function ($model) {
				/* @var $model RESERVED_SERVICE_MODEL */
				return $model->sTAFF != null ? $staff = $model->sTAFF->STAFF_NAME : 'Not Assigned';
			};

			$fields['STATUS'] = function ($model) {
				/* @var $model RESERVED_SERVICE_MODEL */
				return $model->sTATUS != null ? $model->sTATUS->STATUS_NAME : 'Pending';

			};
			unset($fields['STAFF_ID']);
			unset($fields['STATUS_ID']);
		}
		return $fields;
	}

	public static function ServicesReservedCount($offered_service_id)
	{
		$data = self::find()->where(['OFFERED_SERVICE_ID' => $offered_service_id])->count('OFFERED_SERVICE_ID');
		return $data;
	}
}