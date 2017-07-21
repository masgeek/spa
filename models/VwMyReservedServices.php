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
            [['RESERVATION_ID', 'USER_ID', 'STATUS_ID'], 'integer'],
            [['USER_ID', 'RESERVATION_DATE', 'TOTAL_COST', 'SALON_NAME'], 'required'],
            [['RESERVATION_DATE'], 'safe'],
            [['TOTAL_COST'], 'number'],
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
            'USER_ID' => 'User  ID',
            'RESERVATION_DATE' => 'Reservation  Date',
            'TOTAL_COST' => 'Total  Cost',
            'STATUS_ID' => 'Status  ID',
            'SALON_NAME' => 'Salon  Name',
        ];
    }
}
