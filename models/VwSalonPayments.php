<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_salon_payments".
 *
 * @property string $ACCOUNT_REF
 * @property int $PAYMENT_ID
 * @property int $RESERVATION_ID
 * @property string $BOOKING_AMOUNT
 * @property string $FINAL_AMOUNT
 * @property string $DATE_PAID
 * @property string $PAYMENT_REF
 * @property int $PAYMENT_STATUS
 * @property string $BALANCE
 * @property string $MPESA_REF
 * @property string $COMMENTS
 * @property string $STATUS
 * @property string $SALON_TEL
 * @property int $OWNER_ID
 */
class VwSalonPayments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_salon_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACCOUNT_REF', 'RESERVATION_ID', 'BOOKING_AMOUNT', 'DATE_PAID', 'PAYMENT_REF', 'BALANCE', 'MPESA_REF', 'SALON_TEL', 'OWNER_ID'], 'required'],
            [['PAYMENT_ID', 'RESERVATION_ID', 'PAYMENT_STATUS', 'OWNER_ID'], 'integer'],
            [['BOOKING_AMOUNT', 'FINAL_AMOUNT', 'BALANCE'], 'number'],
            [['DATE_PAID'], 'safe'],
            [['COMMENTS'], 'string'],
            [['ACCOUNT_REF', 'PAYMENT_REF'], 'string', 'max' => 50],
            [['MPESA_REF'], 'string', 'max' => 25],
            [['STATUS'], 'string', 'max' => 10],
            [['SALON_TEL'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACCOUNT_REF' => 'Account  Ref',
            'PAYMENT_ID' => 'Payment  ID',
            'RESERVATION_ID' => 'Reservation  ID',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'FINAL_AMOUNT' => 'Final  Amount',
            'DATE_PAID' => 'Date  Paid',
            'PAYMENT_REF' => 'Payment  Ref',
            'PAYMENT_STATUS' => 'Payment  Status',
            'BALANCE' => 'Balance',
            'MPESA_REF' => 'Mpesa  Ref',
            'COMMENTS' => 'Comments',
            'STATUS' => 'Status',
            'SALON_TEL' => 'Salon  Tel',
            'OWNER_ID' => 'Owner  ID',
        ];
    }
}
