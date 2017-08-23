<?php
/**
 * Created by PhpStorm.
 * User: RONIN
 * Date: 8/22/2017
 * Time: 4:39 PM
 */

namespace app\models_search;

use Yii;
use app\model_extended\ALL_PAYMENTS;
use yii\data\ActiveDataProvider;


class PaymentSearch extends ALL_PAYMENTS
{
	public $START_DATE;
	public $END_DATE;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['DATE_PAID','PAYMENT_STATUS'], 'safe'],
		];
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
		$query = ALL_PAYMENTS::find();

		// add conditions that should always apply here

		//$query->groupBy('SERVICE_NAME');
		$query->where(['OWNER_ID' => $owner]);
		$query->orderBy(['DATE_PAID' => SORT_DESC]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		if ($this->DATE_PAID != null) {
			$date = explode("TO", $this->DATE_PAID);
			$this->START_DATE = trim($date[0]);
			$this->END_DATE = trim($date[1]);
		} else {
			$this->START_DATE = date('Y-m-d');
			$this->END_DATE = date('Y-m-d');
		}

		// grid filtering conditions
		$query->andFilterWhere([
			'PAYMENT_STATUS' => $this->PAYMENT_STATUS,
		]);

		//$query->andFilterWhere(['like', 'PAYMENT_REF', $this->PAYMENT_REF]);
		$query->andFilterWhere(['between', 'DATE_PAID', $this->START_DATE, $this->END_DATE]);

		return $dataProvider;
	}
}