<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gas;

/**
 * GasSearch represents the model behind the search form of `app\models\Gas`.
 */
class GasSearch extends Gas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['street_and_num', 'sum', 'additionally', 'gas_insurance'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Gas::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'street_and_num', $this->street_and_num])
            ->andFilterWhere(['like', 'sum', $this->sum])
            ->andFilterWhere(['like', 'additionally', $this->additionally])
            ->andFilterWhere(['like', 'gas_insurance', $this->gas_insurance]);

        return $dataProvider;
    }
}
