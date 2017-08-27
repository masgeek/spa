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
 * @property string $TIME_PAID
 * @property string $PAYMENT_REF
 * @property int $PAYMENT_STATUS
 * @property string $BALANCE
 * @property string $MPESA_REF
 * @property string $COMMENTS
 *
 * @property Reservations $rESERVATION
 * @property PaymentStatus $pAYMENTSTATUS
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
            [['RESERVATION_ID', 'BOOKING_AMOUNT', 'DATE_PAID', 'PAYMENT_REF', 'BALANCE', 'MPESA_REF'], 'required'],
            [['RESERVATION_ID', 'PAYMENT_STATUS'], 'integer'],
            [['BOOKING_AMOUNT', 'FINAL_AMOUNT', 'BALANCE'], 'number'],
            [['DATE_PAID', 'TIME_PAID'], 'safe'],
            [['COMMENTS'], 'string'],
            [['PAYMENT_REF'], 'string', 'max' => 50],
            [['MPESA_REF'], 'string', 'max' => 25],
            [['RESERVATION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Reservations::className(), 'targetAttribute' => ['RESERVATION_ID' => 'RESERVATION_ID']],
            [['PAYMENT_STATUS'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentStatus::className(), 'targetAttribute' => ['PAYMENT_STATUS' => 'PAYMENT_STATUS_ID']],
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
            'TIME_PAID' => 'Time  Paid',
            'PAYMENT_REF' => 'Payment  Ref',
            'PAYMENT_STATUS' => 'Payment  Status',
            'BALANCE' => 'Balance',
            'MPESA_REF' => 'Mpesa  Ref',
            'COMMENTS' => 'Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRESERVATION()
    {
        return $this->hasOne(Reservations::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPAYMENTSTATUS()
    {
        return $this->hasOne(PaymentStatus::className(), ['PAYMENT_STATUS_ID' => 'PAYMENT_STATUS']);
    }
}
