<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserved_services".
 *
 * @property int $RESERVED_SERVICE_ID
 * @property int $OFFERED_SERVICE_ID
 * @property int $STAFF_ID
 * @property int $RESERVATION_ID
 * @property string $SERVICE_AMOUNT
 * @property int $STATUS_ID
 *
 * @property Reservations $rESERVATION
 * @property OfferedServices $oFFEREDSERVICE
 * @property Staff $sTAFF
 * @property Status $sTATUS
 */
class ReservedServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reserved_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OFFERED_SERVICE_ID', 'RESERVATION_ID'], 'required'],
            [['OFFERED_SERVICE_ID', 'STAFF_ID', 'RESERVATION_ID', 'STATUS_ID'], 'integer'],
            [['SERVICE_AMOUNT'], 'number'],
            [['RESERVATION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Reservations::className(), 'targetAttribute' => ['RESERVATION_ID' => 'RESERVATION_ID']],
            [['OFFERED_SERVICE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OfferedServices::className(), 'targetAttribute' => ['OFFERED_SERVICE_ID' => 'OFFERED_SERVICE_ID']],
            [['STAFF_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['STAFF_ID' => 'STAFF_ID']],
            [['STATUS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['STATUS_ID' => 'STATUS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RESERVED_SERVICE_ID' => 'Reserved  Service  ID',
            'OFFERED_SERVICE_ID' => 'Offered  Service  ID',
            'STAFF_ID' => 'Staff  ID',
            'RESERVATION_ID' => 'Reservation  ID',
            'SERVICE_AMOUNT' => 'Service  Amount',
            'STATUS_ID' => 'Status  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRESERVATION()
    {
        return $this->hasOne(Reservations::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOFFEREDSERVICE()
    {
        return $this->hasOne(OfferedServices::className(), ['OFFERED_SERVICE_ID' => 'OFFERED_SERVICE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTAFF()
    {
        return $this->hasOne(Staff::className(), ['STAFF_ID' => 'STAFF_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTATUS()
    {
        return $this->hasOne(Status::className(), ['STATUS_ID' => 'STATUS_ID']);
    }
}
