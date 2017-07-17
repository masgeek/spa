<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property int $RESERVATION_ID
 * @property int $USER_ID
 * @property string $RESERVATION_DATE
 * @property string $RESERVATION_TIME
 * @property string $TOTAL_COST
 * @property int $STATUS_ID
 *
 * @property Payments[] $payments
 * @property User $uSER
 * @property Status $sTATUS
 * @property ReservedServices[] $reservedServices
 */
class Reservations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID', 'STATUS_ID'], 'integer'],
            [['USER_ID','RESERVATION_DATE', 'RESERVATION_TIME'], 'required'],
            [['RESERVATION_DATE', 'RESERVATION_TIME'], 'safe'],
            [['TOTAL_COST'], 'number'],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
            [['STATUS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['STATUS_ID' => 'STATUS_ID']],
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
            'RESERVATION_TIME' => 'Reservation  Time',
            'TOTAL_COST' => 'Total  Cost',
            'STATUS_ID' => 'Status  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUSER()
    {
        return $this->hasOne(User::className(), ['USER_ID' => 'USER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTATUS()
    {
        return $this->hasOne(Status::className(), ['STATUS_ID' => 'STATUS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservedServices()
    {
        return $this->hasMany(ReservedServices::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }
}
