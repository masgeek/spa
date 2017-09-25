<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_all_reservations".
 *
 * @property string $SALON_NAME
 * @property string $SERVICE_NAME
 * @property string $SERVICE_COST
 * @property int $STATUS_ID
 * @property string $BOOKING_AMOUNT
 * @property string $TOTAL_COST
 * @property string $AMOUNT_PAID
 * @property string $BALANCE
 * @property string $DATE_PAID
 * @property string $MPESA_REF
 * @property int $OWNER_ID
 * @property string $RESERVATION_DATE
 * @property string $COMMENTS
 * @property int $SERVICE_ID
 * @property int $RESERVATION_ID
 * @property string $PAYMENT_REF
 * @property int $SALON_ID
 */
class VwAllReservations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_all_reservations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SALON_NAME', 'SERVICE_NAME', 'SERVICE_COST', 'OWNER_ID'], 'required'],
            [['SERVICE_COST', 'BOOKING_AMOUNT', 'TOTAL_COST', 'AMOUNT_PAID', 'BALANCE'], 'number'],
            [['STATUS_ID', 'OWNER_ID', 'SERVICE_ID', 'RESERVATION_ID', 'SALON_ID'], 'integer'],
            [['DATE_PAID', 'RESERVATION_DATE'], 'safe'],
            [['COMMENTS'], 'string'],
            [['SALON_NAME', 'SERVICE_NAME'], 'string', 'max' => 255],
            [['MPESA_REF'], 'string', 'max' => 25],
            [['PAYMENT_REF'], 'string', 'max' => 50],
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
            'SERVICE_COST' => 'Service  Cost',
            'STATUS_ID' => 'Status  ID',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'TOTAL_COST' => 'Total  Cost',
            'AMOUNT_PAID' => 'Amount  Paid',
            'BALANCE' => 'Balance',
            'DATE_PAID' => 'Date  Paid',
            'MPESA_REF' => 'Mpesa  Ref',
            'OWNER_ID' => 'Owner  ID',
            'RESERVATION_DATE' => 'Reservation  Date',
            'COMMENTS' => 'Comments',
            'SERVICE_ID' => 'Service  ID',
            'RESERVATION_ID' => 'Reservation  ID',
            'PAYMENT_REF' => 'Payment  Ref',
            'SALON_ID' => 'Salon  ID',
        ];
    }
}
