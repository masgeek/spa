<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $STATUS_ID
 * @property string $STATUS_NAME
 *
 * @property Reservations[] $reservations
 * @property ReservedServices[] $reservedServices
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS_ID', 'STATUS_NAME'], 'required'],
            [['STATUS_ID'], 'integer'],
            [['STATUS_NAME'], 'string', 'max' => 255],
            [['STATUS_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STATUS_ID' => 'Status  ID',
            'STATUS_NAME' => 'Status  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservations::className(), ['STATUS_ID' => 'STATUS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservedServices()
    {
        return $this->hasMany(ReservedServices::className(), ['STATUS_ID' => 'STATUS_ID']);
    }
}
