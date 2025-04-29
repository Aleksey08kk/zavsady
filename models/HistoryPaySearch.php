<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoryPay;

/**
 * HistoryPaySearch represents the model behind the search form of `app\models\HistoryPay`.
 */
class HistoryPaySearch extends HistoryPay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sum'], 'integer'],
            [['when_date', 'address', 'name', 'messege'], 'safe'],
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
        $query = HistoryPay::find();

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
            'sum' => $this->sum,
            'messege' => $this->messege,
        ]);

        $query->andFilterWhere(['like', 'when_date', $this->when_date])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'messege', $this->messege])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
