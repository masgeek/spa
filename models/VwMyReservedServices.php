<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_my_reserved_services".
 *
 * @property int $RESERVATION_ID
 * @property int $USER_ID
 * @property string $RESERVATION_DATE
 * @property string $TOTAL_COST
 * @property int $STATUS_ID
 * @property string $SALON_NAME
 * @property int $SALON_ID
 * @property string $ACCOUNT_REF
 * @property string $BOOKING_AMOUNT
 */
class VwMyReservedServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_my_reserved_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESERVATION_ID', 'USER_ID', 'STATUS_ID', 'SALON_ID'], 'integer'],
            [['USER_ID', 'RESERVATION_DATE', 'TOTAL_COST', 'SALON_NAME', 'ACCOUNT_REF'], 'required'],
            [['RESERVATION_DATE'], 'safe'],
            [['TOTAL_COST', 'BOOKING_AMOUNT'], 'number'],
            [['SALON_NAME'], 'string', 'max' => 255],
            [['ACCOUNT_REF'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RESERVATION_ID' => 'Reservation  ID',
            'USER_ID' => 'User  ID',
            'RESERVATION_DATE' => 'Reservation  Date',
            'TOTAL_COST' => 'Total  Cost',
            'STATUS_ID' => 'Status  ID',
            'SALON_NAME' => 'Salon  Name',
            'SALON_ID' => 'Salon  ID',
            'ACCOUNT_REF' => 'Account  Ref',
            'BOOKING_AMOUNT' => 'Booking  Amount',
        ];
    }
}
