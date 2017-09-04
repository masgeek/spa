<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property int $REPORT_ID
 * @property int $SALON_OWNER_ID
 * @property string $REPORT_URL
 * @property string $REPORT_TYPE
 * @property string $DATE_GENERATED
 * @property string $EXPIRY_DATE
 * @property string $STATUS
 *
 * @property User $sALONOWNER
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SALON_OWNER_ID', 'REPORT_URL', 'REPORT_TYPE', 'DATE_GENERATED', 'EXPIRY_DATE'], 'required'],
            [['SALON_OWNER_ID'], 'integer'],
            [['DATE_GENERATED', 'EXPIRY_DATE'], 'safe'],
            [['REPORT_URL'], 'string', 'max' => 255],
            [['REPORT_TYPE'], 'string', 'max' => 30],
            [['STATUS'], 'string', 'max' => 10],
            [['SALON_OWNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['SALON_OWNER_ID' => 'USER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REPORT_ID' => 'Report  ID',
            'SALON_OWNER_ID' => 'Salon  Owner  ID',
            'REPORT_URL' => 'Report  Url',
            'REPORT_TYPE' => 'Report  Type',
            'DATE_GENERATED' => 'Date  Generated',
            'EXPIRY_DATE' => 'Expiry  Date',
            'STATUS' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSALONOWNER()
    {
        return $this->hasOne(User::className(), ['USER_ID' => 'SALON_OWNER_ID']);
    }
}
