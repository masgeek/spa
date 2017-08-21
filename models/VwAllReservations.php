<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_all_reservations".
 *
 * @property string $SALON_NAME
 * @property string $SERVICE_NAME
 * @property string $RESERVATION_DATE
 * @property string $SERVICE_COST
 * @property int $STATUS_ID
 * @property string $BOOKING_AMOUNT
 * @property string $TOTAL_COST
 * @property string $AMOUNT_PAID
 * @property string $BALANCE
 * @property string $DATE_PAID
 * @property string $PAYMENT_REF
 * @property int $OWNER_ID
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
            [['SALON_NAME', 'SERVICE_NAME', 'RESERVATION_DATE', 'SERVICE_COST', 'OWNER_ID'], 'required'],
            [['RESERVATION_DATE', 'DATE_PAID'], 'safe'],
            [['SERVICE_COST', 'BOOKING_AMOUNT', 'TOTAL_COST', 'AMOUNT_PAID', 'BALANCE'], 'number'],
            [['STATUS_ID', 'OWNER_ID'], 'integer'],
            [['SALON_NAME', 'SERVICE_NAME'], 'string', 'max' => 255],
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
            'RESERVATION_DATE' => 'Reservation  Date',
            'SERVICE_COST' => 'Service  Cost',
            'STATUS_ID' => 'Status  ID',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'TOTAL_COST' => 'Total  Cost',
            'AMOUNT_PAID' => 'Amount  Paid',
            'BALANCE' => 'Balance',
            'DATE_PAID' => 'Date  Paid',
            'PAYMENT_REF' => 'Payment  Ref',
            'OWNER_ID' => 'Owner  ID',
        ];
    }
}
