<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 10:04 AM
 */

namespace app\model_extended;


use app\models\VwAllReservations;

/**
 * This is the model class for table "salon".
 *
 * @property ALL_SERVICES $sERVICE
 */
class ALL_RESERVATIONS extends VwAllReservations
{
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSERVICE()
	{
		return $this->hasOne(ALL_SERVICES::className(), ['SERVICE_ID' => 'SERVICE_ID']);
	}
}