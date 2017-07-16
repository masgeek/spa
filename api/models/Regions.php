<?php

namespace app\api\models;

use Yii;

/**
 * This is the model class for table "tb_regions".
 *
 * @property int $REGION_ID
 * @property string $REGION_NAME
 * @property string $DATE_ADDED
 * @property int $TIMESTAMP
 *
 * @property Clinics[] $clinics
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_regions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REGION_NAME', 'DATE_ADDED', 'TIMESTAMP'], 'required'],
            [['DATE_ADDED'], 'safe'],
            [['TIMESTAMP'], 'integer'],
            [['REGION_NAME'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REGION_ID' => 'Region  ID',
            'REGION_NAME' => 'Region  Name',
            'DATE_ADDED' => 'Date  Added',
            'TIMESTAMP' => 'Timestamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinics()
    {
        return $this->hasMany(Clinics::className(), ['REGION_ID' => 'REGION_ID']);
    }
}
