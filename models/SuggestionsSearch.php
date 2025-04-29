<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Suggestions;

/**
 * SuggestionsSearch represents the model behind the search form of `app\models\Suggestions`.
 */
class SuggestionsSearch extends Suggestions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'under_consideration', 'approved', 'cancelled', 'in_process', 'postponed', 'completed', 'modification'], 'integer'],
            [['address', 'name', 'phone', 'suggestion', 'cancelled_reason', 'postponed_reason', 'date_last_update', 'date_create'], 'safe'],
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
        $query = Suggestions::find();

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
            'under_consideration' => $this->under_consideration,
            'approved' => $this->approved,
            'cancelled' => $this->cancelled,
            'in_process' => $this->in_process,
            'postponed' => $this->postponed,
            'completed' => $this->completed,
            'modification' => $this->modification,
            'date_last_update' => $this->date_last_update,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'suggestion', $this->suggestion])
            ->andFilterWhere(['like', 'cancelled_reason', $this->cancelled_reason])
            ->andFilterWhere(['like', 'postponed_reason', $this->postponed_reason]);

        return $dataProvider;
    }
}
