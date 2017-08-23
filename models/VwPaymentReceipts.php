<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_payment_receipts".
 *
 * @property string $SALON_NAME
 * @property string $SERVICE_NAME
 * @property int $PAYMENT_ID
 * @property int $RESERVATION_ID
 * @property string $BOOKING_AMOUNT
 * @property string $DATE_PAID
 * @property string $PAYMENT_REF
 * @property int $PAYMENT_STATUS
 * @property string $BALANCE
 * @property string $MPESA_REF
 * @property string $COMMENTS
 */
class VwPaymentReceipts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_payment_receipts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SALON_NAME', 'SERVICE_NAME', 'RESERVATION_ID', 'BOOKING_AMOUNT', 'DATE_PAID', 'PAYMENT_REF', 'BALANCE', 'MPESA_REF'], 'required'],
            [['PAYMENT_ID', 'RESERVATION_ID', 'PAYMENT_STATUS'], 'integer'],
            [['BOOKING_AMOUNT', 'BALANCE'], 'number'],
            [['DATE_PAID'], 'safe'],
            [['COMMENTS'], 'string'],
            [['SALON_NAME', 'SERVICE_NAME'], 'string', 'max' => 255],
            [['PAYMENT_REF'], 'string', 'max' => 50],
            [['MPESA_REF'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SALON_NAME' => 'Salon  Name',
            'SERVICE_NAME' => 'Service  Name',
            'PAYMENT_ID' => 'Payment  ID',
            'RESERVATION_ID' => 'Reservation  ID',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'DATE_PAID' => 'Date  Paid',
            'PAYMENT_REF' => 'Payment  Ref',
            'PAYMENT_STATUS' => 'Payment  Status',
            'BALANCE' => 'Balance',
            'MPESA_REF' => 'Mpesa  Ref',
            'COMMENTS' => 'Comments',
        ];
    }
}
