<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 7/16/2017
 * Time: 10:30 PM
 */

namespace app\api\modules\v1\models;


use app\models\OfferedServices;
/**
*
* @property Services $sERVICE
* @property Salon $sALON
*/
class OFFERED_SERVICE_MODEL extends OfferedServices
{
	public $SALON;

	public function fields()
	{
		$fields = parent::fields();

		$fields['SERVICE_NAME'] = function ($model) {
			/* @var $model OFFERED_SERVICE_MODEL */
			return $model->sERVICE->SERVICE_NAME;
		};
		$fields['SALON'] = function ($model) {
			/* @var $model OFFERED_SERVICE_MODEL */
			return $model->sALON;
		};


		//unset($fields['SERVICE_COST']);
		return $fields;
	}
}