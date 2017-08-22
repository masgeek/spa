<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_my_reservations".
 *
 * @property int $RESERVATION_ID
 * @property string $RESERVATION_DATE
 * @property string $TOTAL_COST
 * @property int $STATUS_ID
 * @property string $ACCOUNT_REF
 * @property string $BOOKING_AMOUNT
 * @property string $SALON_NAME
 * @property string $SURNAME
 * @property int $OWNER_ID
 * @property int $RESERVER_ID
 * @property string $COMMENTS
 */
class VwMyReservations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_my_reservations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESERVATION_ID', 'STATUS_ID', 'OWNER_ID', 'RESERVER_ID'], 'integer'],
            [['RESERVATION_DATE', 'TOTAL_COST', 'ACCOUNT_REF', 'SALON_NAME', 'SURNAME', 'RESERVER_ID'], 'required'],
            [['RESERVATION_DATE'], 'safe'],
            [['TOTAL_COST', 'BOOKING_AMOUNT'], 'number'],
            [['COMMENTS'], 'string'],
            [['ACCOUNT_REF'], 'string', 'max' => 50],
            [['SALON_NAME'], 'string', 'max' => 255],
            [['SURNAME'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RESERVATION_ID' => 'Reservation  ID',
            'RESERVATION_DATE' => 'Reservation  Date',
            'TOTAL_COST' => 'Total  Cost',
            'STATUS_ID' => 'Status  ID',
            'ACCOUNT_REF' => 'Account  Ref',
            'BOOKING_AMOUNT' => 'Booking  Amount',
            'SALON_NAME' => 'Salon  Name',
            'SURNAME' => 'Surname',
            'OWNER_ID' => 'Owner  ID',
            'RESERVER_ID' => 'Reserver  ID',
            'COMMENTS' => 'Comments',
        ];
    }
}
