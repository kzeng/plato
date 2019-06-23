<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BorrowingRules;

/**
 * BorrowingRulesSearch represents the model behind the search form of `common\models\BorrowingRules`.
 */
class BorrowingRulesSearch extends BorrowingRules
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'general_loan_period', 'extended_period_impunity', 'first_term_of_punishment', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'reader_type_ids', 'circulation_type_ids'], 'safe'],
            [['first_penalty_unit_price', 'other__unit_price'], 'number'],
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
        $query = BorrowingRules::find();

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
            'general_loan_period' => $this->general_loan_period,
            'extended_period_impunity' => $this->extended_period_impunity,
            'first_term_of_punishment' => $this->first_term_of_punishment,
            'first_penalty_unit_price' => $this->first_penalty_unit_price,
            'other__unit_price' => $this->other__unit_price,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'reader_type_ids', $this->reader_type_ids])
            ->andFilterWhere(['like', 'circulation_type_ids', $this->circulation_type_ids]);

        return $dataProvider;
    }
}
