<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property int $STAFF_ID
 * @property int $SALON_ID
 * @property string $STAFF_NAME
 * @property string $STAFF_TEL
 *
 * @property ReservedServices[] $reservedServices
 * @property Salon $sALON
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SALON_ID'], 'integer'],
            [['STAFF_NAME', 'STAFF_TEL'], 'string', 'max' => 255],
            [['SALON_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Salon::className(), 'targetAttribute' => ['SALON_ID' => 'SALON_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'STAFF_ID' => 'Staff  ID',
            'SALON_ID' => 'Salon  ID',
            'STAFF_NAME' => 'Staff  Name',
            'STAFF_TEL' => 'Staff  Tel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservedServices()
    {
        return $this->hasMany(ReservedServices::className(), ['STAFF_ID' => 'STAFF_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSALON()
    {
        return $this->hasOne(Salon::className(), ['SALON_ID' => 'SALON_ID']);
    }
}
