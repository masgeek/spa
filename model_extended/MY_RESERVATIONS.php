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

	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			// Place your custom code here
			if (!$this->isNewRecord) {
				//only handle for update scenarios
				$this->CancelReservations($this->RESERVATION_ID);
			}
			return true;
		} else {
			return false;
		}
	}

	private function CancelReservations($reservation_id)
	{
//Comment::updateAll(['status' => 1, 'updated' => '2011-08-25 09:33:23'], 'type_id = 1 AND status = 0' );
		self::updateAll([
			'BOOKING_AMOUNT' => (-$this->BOOKING_AMOUNT),
			'TOTAL_COST' => (-$this->TOTAL_COST)
		], "RESERVATION_ID={$reservation_id}");

		//then update the payments
		//\Yii::$app()->db->createCommand("UPDATE payments SET BOOKING_AMMOUNT = -BOOKING_AMOUNT WERE RESERVATION_ID={$reservation_id}")->execute();
		/*MY_PAYMENTS_MODEL::updateAll([
			'BOOKING_AMOUNT' => (-$this->BOOKING_AMOUNT),
			'FINAL_AMOUNT' => (-$this->TOTAL_COST)
		], "RESERVATION_ID={$reservation_id}");*/
		$connection = self::getDb();
		$command = $connection->createCommand("
		UPDATE payments SET BOOKING_AMOUNT = (-1*BOOKING_AMOUNT), FINAL_AMOUNT = (-1*FINAL_AMOUNT),BALANCE = 0,PAYMENT_STATUS = 2
    WHERE  RESERVATION_ID=:reservation_id AND BOOKING_AMOUNT > 0 AND FINAL_AMOUNT >0", [':reservation_id' => $reservation_id])->execute();
	}

	/**
	 * @param $reservation_id
	 * @return \app\models\User
	 */
	public static function GetCustomerInfo($reservation_id)
	{
		return self::findOne($reservation_id)->uSER;
	}
}