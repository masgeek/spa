<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "salon".
 *
 * @property int $SALON_ID
 * @property string $SALON_NAME
 * @property string $SALON_TEL
 * @property string $SALON_LOCATION
 * @property string $SALON_EMAIL
 * @property string $SALON_WEBSITE
 * @property string $SALON_IMAGE
 * @property string $DESCRIPTION
 *
 * @property OfferedServices[] $offeredServices
 * @property Staff[] $staff
 */
class Salon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'salon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SALON_NAME', 'SALON_TEL'], 'required'],
            [['DESCRIPTION'], 'string'],
            [['SALON_NAME', 'SALON_TEL', 'SALON_LOCATION', 'SALON_EMAIL', 'SALON_WEBSITE', 'SALON_IMAGE'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SALON_ID' => 'Salon  ID',
            'SALON_NAME' => 'Salon  Name',
            'SALON_TEL' => 'Salon  Tel',
            'SALON_LOCATION' => 'Salon  Location',
            'SALON_EMAIL' => 'Salon  Email',
            'SALON_WEBSITE' => 'Salon  Website',
            'SALON_IMAGE' => 'Salon  Image',
            'DESCRIPTION' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferedServices()
    {
        return $this->hasMany(OfferedServices::className(), ['SALON_ID' => 'SALON_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['SALON_ID' => 'SALON_ID']);
    }
}
