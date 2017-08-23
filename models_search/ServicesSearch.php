<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 23-Aug-17
 * Time: 12:05
 */

namespace app\models_search;

use app\model_extended\ALL_RESERVATIONS;
use app\model_extended\RESERVED_SERVICES;
use app\model_extended\SERVICES_COUNT_MODEL;
use Yii;
use app\model_extended\ALL_SERVICES;
use app\models\VwAllServices;
use yii\data\ActiveDataProvider;

class ServicesSearch extends SERVICES_COUNT_MODEL
{
    public $START_DATE;
    public $END_DATE;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['SALON_ID', 'SALON_NAME'], 'safe'],
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
        $query = VwAllServices::find();

        // add conditions that should always apply here
        //$query->groupBy('SERVICE_NAME');
        $query->where(['OWNER_ID' => $owner]);
        //$query->orderBy(['RESERVATIONS' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            return $dataProvider;
        }

        $query->andFilterWhere([
            'SALON_ID' => $this->SALON_ID,
            'SALON_NAME' => $this->SALON_NAME,
        ]);

	    $query->andFilterWhere(['like', 'SALON_NAME', $this->SALON_NAME])
		    ->andFilterWhere(['like', 'SALON_ID', $this->SALON_ID]);
        return $dataProvider;
    }
}