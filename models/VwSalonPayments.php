<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_salon_payments".
 *
 * @property int $PAYMENT_ID
 * @property int $RESERVATION_ID
 * @property string $BOOKING_AMOUNT
 * @property string $FINAL_AMOUNT
 * @property string $DATE_PAID
 * @property string $PAYMENT_REF
 * @property int $FINALIZED
 * @property string $BALANCE
 * @property string $ACCOUNT_REF
 * @property string $SALON_NAME
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
            [['PAYMENT_ID', 'RESERVATION_ID', 'FINALIZED', 'OWNER_ID'], 'integer'],
            [['RESERVATION_ID', 'BOOKING_AMOUNT', 'DATE_PAID', 'PAYMENT_REF', 'BALANCE', 'ACCOUNT_REF', 'SALON_NAME', 'OWNER_ID'], 'required'],
            [['BOOKING_AMOUNT', 'FINAL_AMOUNT', 'BALANCE'], 'number'],
            [['DATE_PAID'], 'safe'],
            [['PAYMENT_REF', 'ACCOUNT_REF'], 'string', 'max' => 50],
            [['SALON_NAME'], 'string', 'max' => 255],
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
            'PAYMENT_REF' => 'Payment  Ref',
            'FINALIZED' => 'Finalized',
            'BALANCE' => 'Balance',
            'ACCOUNT_REF' => 'Account  Ref',
            'SALON_NAME' => 'Salon  Name',
            'OWNER_ID' => 'Owner  ID',
        ];
    }
}
