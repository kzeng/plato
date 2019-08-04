<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PaymentOfDebt;

/**
 * PaymentOfDebtSearch represents the model behind the search form of `common\models\PaymentOfDebt`.
 */
class PaymentOfDebtSearch extends PaymentOfDebt
{
    public $reader_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'violation_type_id', 'payment_status', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['description', 'reader_id', 'reader_name', 'card_number'], 'safe'],
            [['penalty'], 'number'],
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
        $query = PaymentOfDebt::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => ['pageSize' => 20],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->join('INNER JOIN', 'reader', 'reader.id = payment_of_debt.reader_id');

        // grid filtering conditions
        $query->andFilterWhere([
            'payment_of_debt.id' => $this->id,
            'violation_type_id' => $this->violation_type_id,
            'payment_status' => $this->payment_status,
            'penalty' => $this->penalty,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
              ->andFilterWhere(['like', 'reader.card_number', $this->card_number])
              ->andFilterWhere(['like', 'reader.reader_name', $this->reader_name]);

        return $dataProvider;
    }
}
