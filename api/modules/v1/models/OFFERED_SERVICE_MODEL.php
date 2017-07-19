<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 10:30 PM
 */

namespace app\api\modules\v1\models;


use app\models\OfferedServices;

class OFFERED_SERVICE_MODEL extends OfferedServices
{
	public $SALON;

	public function fields()
	{
		$fields = parent::fields();

		$fields['SALON'] = function ($model) {
			/* @var $model OFFERED_SERVICE_MODEL */
			return [
				'SALON_NAME' => $model->sALON->SALON_NAME,
				'SALON_LOCATION' => $model->sALON->SALON_LOCATION,
			];
		};

        $fields['SERVICE'] = function ($model) {
            /* @var $model SERVICE_MODEL */
            return [
                'SALON_NAME' => $model->SERVICE_NAME,
                'SALON_LOCATION' => $model->SERVICE_ID,
            ];
        };
		//unset($fields['SERVICE_COST']);
		return $fields;
	}
}