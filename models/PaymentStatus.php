<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_status".
 *
 * @property int $PAYMENT_STATUS_ID
 * @property string $STATUS
 *
 * @property Payments[] $payments
 */
class PaymentStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['STATUS'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PAYMENT_STATUS_ID' => 'Payment  Status  ID',
            'STATUS' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['PAYMENT_STATUS' => 'PAYMENT_STATUS_ID']);
    }
}
