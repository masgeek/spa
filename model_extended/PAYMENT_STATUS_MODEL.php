<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 9:43 AM
 */

namespace app\model_extended;


use app\models\PaymentStatus;
use yii\helpers\ArrayHelper;

class PAYMENT_STATUS_MODEL extends PaymentStatus
{
	public function attributeLabels()
	{
		$labels = parent::attributeLabels();

		$labels['PAYMENT_STATUS_ID'] = 'Status';

		return $labels;
	}


	public static function GetStatus()
	{
		$arr = self::find()->asArray()->all();

		$items = ArrayHelper::map($arr, 'PAYMENT_STATUS_ID', 'STATUS');

		return $items;
	}
}