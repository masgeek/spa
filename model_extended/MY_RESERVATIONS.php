<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 25-Jul-17
 * Time: 13:17
 */

namespace app\model_extended;


use app\models\Reservations;

class MY_RESERVATIONS extends Reservations
{
	public $USER_NAME;
	const SCENNARIO_CONFIRMATION = 'confirmation';

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		//$scenarios[self::SCENARIO_CREATE] = ['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD', 'ACCOUNT_TYPE_ID', 'ACCOUNT_STATUS', 'ACCOUNT_TYPE_ID'];
		//$scenarios[self::SCENARIO_UPDATE] = ['SURNAME', 'EMAIL', 'MOBILE_NO', 'PASSWORD', 'ACCOUNT_TYPE_ID', 'ACCOUNT_TYPE_ID'];

		return $scenarios;
	}

	public function rules()
	{
		$rules = parent::rules();
		$rules[] = [['COMMENTS'], 'required'];
		return $rules;
	}

	public function attributeLabels()
	{
		$labels = parent::attributeLabels();

		$labels['STATUS_ID'] = 'Reservation Status';

		return $labels;
	}

	/**
	 * @param $reservation_id
	 * @return \app\models\User
	 */
	public static function GetCustomerInfo($reservation_id){
		return self::findOne($reservation_id)->uSER;
	}
}