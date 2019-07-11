<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BorrowReturnBooks;

/**
 * BorrowReturnBooksSearch represents the model behind the search form of `common\models\BorrowReturnBooks`.
 */
class BorrowReturnBooksSearch extends BorrowReturnBooks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',  'operation', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['card_number', 'bar_code'], 'safe'],
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
        $query = BorrowReturnBooks::find();

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
            'operation' => $this->operation,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'bar_code', $this->bar_code]);

        return $dataProvider;
    }
}
