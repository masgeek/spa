<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offered_services".
 *
 * @property int $OFFERED_SERVICE_ID
 * @property int $SERVICE_ID
 * @property int $SALON_ID
 * @property string $SERVICE_COST
 * @property int $STATUS 1 for active, 0 for Inactive
 *
 * @property Services $sERVICE
 * @property Salon $sALON
 * @property ReservedServices[] $reservedServices
 */
class OfferedServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offered_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SERVICE_ID', 'SALON_ID', 'SERVICE_COST'], 'required'],
            [['SERVICE_ID', 'SALON_ID', 'STATUS'], 'integer'],
            [['SERVICE_COST'], 'number'],
            [['SERVICE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['SERVICE_ID' => 'SERVICE_ID']],
            [['SALON_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Salon::className(), 'targetAttribute' => ['SALON_ID' => 'SALON_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OFFERED_SERVICE_ID' => 'Offered  Service  ID',
            'SERVICE_ID' => 'Service  ID',
            'SALON_ID' => 'Salon  ID',
            'SERVICE_COST' => 'Service  Cost',
            'STATUS' => '1 for active, 0 for Inactive',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSERVICE()
    {
        return $this->hasOne(Services::className(), ['SERVICE_ID' => 'SERVICE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSALON()
    {
        return $this->hasOne(Salon::className(), ['SALON_ID' => 'SALON_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservedServices()
    {
        return $this->hasMany(ReservedServices::className(), ['OFFERED_SERVICE_ID' => 'OFFERED_SERVICE_ID']);
    }
}
