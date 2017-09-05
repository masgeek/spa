<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_salon_reservations".
 *
 * @property string $SALON_NAME
 * @property int $SALON_ID
 * @property string $SALON_RESERVATONS
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
            [['SALON_NAME'], 'required'],
            [['SALON_ID', 'SALON_RESERVATONS'], 'integer'],
            [['SALON_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SALON_NAME' => 'Salon  Name',
            'SALON_ID' => 'Salon  ID',
            'SALON_RESERVATONS' => 'Salon  Reservatons',
        ];
    }
}
