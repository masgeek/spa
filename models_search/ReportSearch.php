<?php

namespace app\models_search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\model_extended\MY_RESERVATIONS;

/**
 * ReportSearch represents the model behind the search form of `app\model_extended\MY_RESERVATIONS`.
 */
class ReportSearch extends MY_RESERVATIONS
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESERVATION_ID', 'USER_ID', 'STATUS_ID'], 'integer'],
            [['RESERVATION_DATE', 'ACCOUNT_REF'], 'safe'],
            [['TOTAL_COST', 'BOOKING_AMOUNT'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MY_RESERVATIONS::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'RESERVATION_ID' => $this->RESERVATION_ID,
            'USER_ID' => $this->USER_ID,
            'RESERVATION_DATE' => $this->RESERVATION_DATE,
            'TOTAL_COST' => $this->TOTAL_COST,
            'STATUS_ID' => $this->STATUS_ID,
            'BOOKING_AMOUNT' => $this->BOOKING_AMOUNT,
        ]);

        $query->andFilterWhere(['like', 'ACCOUNT_REF', $this->ACCOUNT_REF]);

        return $dataProvider;
    }
}
