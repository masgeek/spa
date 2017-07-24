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

		if($this->isNewRecord){}else {
            $fields['SERVICE_NAME'] = function ($model) {
                /* @var $model OFFERED_SERVICE_MODEL */
                if ($model->sERVICE->SERVICE_NAME != null) {
                    return $model->sERVICE->SERVICE_NAME;
                }
            };

            $fields['SERVICE_DESCRIPTION'] = function ($model) {
                /* @var $model OFFERED_SERVICE_MODEL */
                if ($model->sERVICE->DESCRIPTION) {
                    return $model->sERVICE->DESCRIPTION;
                }
            };
            $fields['SALON_NAME'] = function ($model) {
                /* @var $model OFFERED_SERVICE_MODEL */
                if ($model->sALON->SALON_NAME) {
                    return $model->sALON->SALON_NAME;
                }
            };

        }
		//unset($fields['SERVICE_COST']);
		return $fields;
	}
}