<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $SERVICE_ID
 * @property string $SERVICE_NAME
 * @property string $DESCRIPTION
 *
 * @property OfferedServices[] $offeredServices
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SERVICE_NAME'], 'required'],
            [['DESCRIPTION'], 'string'],
            [['SERVICE_NAME'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SERVICE_ID' => 'Service  ID',
            'SERVICE_NAME' => 'Service  Name',
            'DESCRIPTION' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfferedServices()
    {
        return $this->hasMany(OfferedServices::className(), ['SERVICE_ID' => 'SERVICE_ID']);
    }
}
