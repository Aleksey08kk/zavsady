<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AllLands;

/**
 * AllLandsSearch represents the model behind the search form of `app\models\AllLands`.
 */
class AllLandsSearch extends AllLands
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tel', 'date'], 'integer'],
            [['street_and_num', 'name_owner', 'email', 'debt_str', 'photo', 'how_much_sotok', 'accrual', 'dop_accrual'], 'safe'],
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
        $query = AllLands::find();

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
            'dop_accrual' => $this->dop_accrual,
            'tel' => $this->tel,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'street_and_num', $this->street_and_num])
            ->andFilterWhere(['like', 'how_much_sotok', $this->how_much_sotok])
            ->andFilterWhere(['like', 'name_owner', $this->name_owner])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'debt_str', $this->debt_str])
            ->andFilterWhere(['like', 'dop_accrual', $this->dop_accrual])
            ->andFilterWhere(['like', 'accrual', $this->photo])
            ->andFilterWhere(['like', 'photo', $this->photo]);
            
        return $dataProvider;
    }
}
