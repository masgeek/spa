<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $PAYMENT_ID
 * @property int $RESERVATION_ID
 * @property string $BOOKING_AMOUNT
 * @property string $FINAL_AMOUNT
 * @property string $DATE_PAID
 *
 * @property Reservations $rESERVATION
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESERVATION_ID'], 'required'],
            [['RESERVATION_ID'], 'integer'],
            [['BOOKING_AMOUNT', 'FINAL_AMOUNT'], 'number'],
            [['DATE_PAID'], 'safe'],
            [['RESERVATION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Reservations::className(), 'targetAttribute' => ['RESERVATION_ID' => 'RESERVATION_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAYMENT_ID' => 'Payment  ID',
            'RESERVATION_ID' => 'Reservation  ID',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'FINAL_AMOUNT' => 'Final  Amount',
            'DATE_PAID' => 'Date  Paid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRESERVATION()
    {
        return $this->hasOne(Reservations::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }
}
