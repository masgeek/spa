<?php

namespace app\models_search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\model_extended\USERS_MODEL;

/**
 * UserSearch represents the model behind the search form of `app\model_extended\USERS_MODEL`.
 */
class UserSearch extends USERS_MODEL
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID', 'ACCOUNT_STATUS', 'ACCOUNT_TYPE_ID'], 'integer'],
            [['SURNAME', 'OTHER_NAMES', 'EMAIL', 'MOBILE_NO', 'PASSWORD'], 'safe'],
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
        $query = USERS_MODEL::find();

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
            'USER_ID' => $this->USER_ID,
            //'ACCOUNT_STATUS' => $this->ACCOUNT_STATUS,
            ///'ACCOUNT_TYPE_ID' => $this->ACCOUNT_TYPE_ID,
        ]);

        $query->andFilterWhere(['like', 'SURNAME', $this->SURNAME])
            ->andFilterWhere(['like', 'OTHER_NAMES', $this->OTHER_NAMES])
            ->andFilterWhere(['like', 'EMAIL', $this->EMAIL])
            ->andFilterWhere(['like', 'ACCOUNT_STATUS', $this->ACCOUNT_STATUS])
            ->andFilterWhere(['like', 'ACCOUNT_TYPE_ID', $this->ACCOUNT_TYPE_ID])
            ->andFilterWhere(['like', 'MOBILE_NO', $this->MOBILE_NO])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD]);

        return $dataProvider;
    }
}
