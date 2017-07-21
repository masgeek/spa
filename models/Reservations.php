<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property int $RESERVATION_ID
 * @property int $USER_ID
 * @property string $RESERVATION_DATE
 * @property string $TOTAL_COST
 * @property int $STATUS_ID
 *
 * @property Payments[] $payments
 * @property Status $sTATUS
 * @property User $uSER
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
            [['USER_ID', 'RESERVATION_DATE', 'TOTAL_COST'], 'required'],
            [['USER_ID', 'STATUS_ID'], 'integer'],
            [['RESERVATION_DATE'], 'safe'],
            [['TOTAL_COST'], 'number'],
            [['STATUS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['STATUS_ID' => 'STATUS_ID']],
            [['USER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['USER_ID' => 'USER_ID']],
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
    public function getSTATUS()
    {
        return $this->hasOne(Status::className(), ['STATUS_ID' => 'STATUS_ID']);
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
    public function getReservedServices()
    {
        return $this->hasMany(ReservedServices::className(), ['RESERVATION_ID' => 'RESERVATION_ID']);
    }
}
