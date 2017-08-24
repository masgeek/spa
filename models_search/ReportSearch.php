<?php

namespace app\models_search;

use app\model_extended\ALL_RESERVATIONS;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReportSearch extends ALL_RESERVATIONS
{
	public $CUSTOMER_NAMES;
	public $START_DATE;
	public $END_DATE;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['RESERVATION_DATE'], 'safe'],
			//[['RESERVATION_DATE', 'PAYMENT_REF','MPESA_REF','STATUS_ID'], 'safe'],
			//[['TOTAL_COST', 'BOOKING_AMOUNT'], 'number'],
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
		$owner = Yii::$app->user->id;
		$query = ALL_RESERVATIONS::find();

		// add conditions that should always apply here

		//$query->groupBy('SERVICE_NAME');
		$query->where(['OWNER_ID' => $owner]);
		$query->orderBy(['SERVICE_ID' => SORT_DESC]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		if ($this->RESERVATION_DATE != null) {
			$date = explode("TO", $this->RESERVATION_DATE);
			$this->START_DATE = trim($date[0]);
			$this->END_DATE = trim($date[1]);
		} else {
			$this->START_DATE = date('Y-m-d');
			$this->END_DATE = date('Y-m-d');
		}

		// grid filtering conditions
		/*$query->andFilterWhere([
			'RESERVATION_DATE' => $this->RESERVATION_DATE,
			'TOTAL_COST' => $this->TOTAL_COST,
			'STATUS_ID' => $this->STATUS_ID,
			'BOOKING_AMOUNT' => $this->BOOKING_AMOUNT,
		]);*/

		//$query->andFilterWhere(['like', 'PAYMENT_REF', $this->PAYMENT_REF]);
		$query->andFilterWhere(['between', 'RESERVATION_DATE', $this->START_DATE, $this->END_DATE]);

		return $dataProvider;
	}
}
