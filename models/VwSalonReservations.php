<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_salon_reservations".
 *
 * @property int $RESERVATION_ID
 * @property int $SALON_ID
 * @property string $SALON_NAME
 * @property int $SALON_OWNER_ID
 */
class VwSalonReservations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_salon_reservations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESERVATION_ID', 'SALON_NAME', 'SALON_OWNER_ID'], 'required'],
            [['RESERVATION_ID', 'SALON_ID', 'SALON_OWNER_ID'], 'integer'],
            [['SALON_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RESERVATION_ID' => 'Reservation  ID',
            'SALON_ID' => 'Salon  ID',
            'SALON_NAME' => 'Salon  Name',
            'SALON_OWNER_ID' => 'Salon  Owner  ID',
        ];
    }
}
