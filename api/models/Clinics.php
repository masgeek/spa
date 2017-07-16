<?php

namespace app\api\models;

use Yii;

/**
 * This is the model class for table "tb_clinics".
 *
 * @property int $CLINIC_ID
 * @property int $REGION_ID clinic region nairobi, nakuru etc
 * @property string $CLINIC_NAME clinic name
 * @property double $LAT Map latitude
 * @property double $LONG Map longitude
 * @property string $DATE_ADDED
 * @property int $TIMESTAMP
 *
 * @property Regions $rEGION
 */
class Clinics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_clinics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_ID', 'CLINIC_NAME', 'LAT', 'LONG', 'TIMESTAMP'], 'required'],
            [['REGION_ID', 'TIMESTAMP'], 'integer'],
            [['LAT', 'LONG'], 'number'],
            [['DATE_ADDED'], 'safe'],
            [['CLINIC_NAME'], 'string', 'max' => 50],
            [['REGION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['REGION_ID' => 'REGION_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CLINIC_ID' => 'Clinic  ID',
            'REGION_ID' => 'clinic region nairobi, nakuru etc',
            'CLINIC_NAME' => 'clinic name',
            'LAT' => 'Map latitude',
            'LONG' => 'Map longitude',
            'DATE_ADDED' => 'Date  Added',
            'TIMESTAMP' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREGION()
    {
        return $this->hasOne(Regions::className(), ['REGION_ID' => 'REGION_ID']);
    }
}
