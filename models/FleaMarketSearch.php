<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FleaMarket;

/**
 * FleaMarketSearch represents the model behind the search form of `app\models\FleaMarket`.
 */
class FleaMarketSearch extends FleaMarket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'active', 'allow', 'phone', 'viber', 'date'], 'integer'],
            [['name_customer', 'product', 'photo'], 'safe'],
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
        $query = FleaMarket::find();

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
            'active' => $this->active,
            'allow' => $this->allow,
            'phone' => $this->phone,
            'viber' => $this->viber,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'name_customer', $this->name_customer])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
