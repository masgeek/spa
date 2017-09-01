<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 10:04 AM
 */

namespace app\api\modules\v1\models;


use app\model_extended\ALL_SERVICES;
use app\model_extended\STATUS_MODEL;
use app\models\VwAllReservations;

/**
 * This is the model class for table "salon".
 *
 * @property ALL_SERVICES $sERVICE
 * @property STATUS_MODEL $sTATUS
 */
class ALL_RESERVATIONS extends VwAllReservations
{
	public $CUSTOMER_NAMES;

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();
		$labels['MPESA_REF'] = 'Mpesa Reference';
		$labels['PAYMENT_REF'] = 'Payment Reference';
		return $labels;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSERVICE()
	{
		return $this->hasOne(ALL_SERVICES::className(), ['SERVICE_ID' => 'SERVICE_ID']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSTATUS()
	{
		return $this->hasOne(STATUS_MODEL::className(), ['STATUS_ID' => 'STATUS_ID']);
	}
}