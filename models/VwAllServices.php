<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_all_services".
 *
 * @property string $SERVICE_NAME
 * @property int $SALON_ID
 * @property string $SALON_NAME
 * @property int $OWNER_ID
 * @property int $OFFERED_SERVICE_ID
 * @property string $RESERVATIONS
 * @property string $STATUS_NAME
 * @property int $SERVICE_ID
 */
class VwAllServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_all_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SERVICE_NAME', 'SALON_ID', 'SALON_NAME', 'OWNER_ID'], 'required'],
            [['SALON_ID', 'OWNER_ID', 'OFFERED_SERVICE_ID', 'RESERVATIONS', 'SERVICE_ID'], 'integer'],
            [['SERVICE_NAME', 'SALON_NAME', 'STATUS_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SERVICE_NAME' => 'Service  Name',
            'SALON_ID' => 'Salon  ID',
            'SALON_NAME' => 'Salon  Name',
            'OWNER_ID' => 'Owner  ID',
            'OFFERED_SERVICE_ID' => 'Offered  Service  ID',
            'RESERVATIONS' => 'Reservations',
            'STATUS_NAME' => 'Status  Name',
            'SERVICE_ID' => 'Service  ID',
        ];
    }
}
