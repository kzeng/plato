<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reader;

/**
 * ReaderSearch represents the model behind the search form of `common\models\Reader`.
 */
class ReaderSearch extends Reader
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'card_status', 'validity', 'reader_type_id', 'gender', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['card_number', 'reader_name', 'id_card', 'mobile', 'address'], 'safe'],
            [['deposit', 'creditmoney'], 'number'],
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
        // $query = Reader::find();
        if(\Yii::$app->user->identity->id == 1) /*super admin*/
        {
            $query = Reader::find();
        }
        else //library employee
        {
            $user = User1::findOne(['id' => \Yii::$app->user->identity->id]);

            $query = Reader::find()
                    ->where([
                                'library_id'    => $user->library_id,
                                'status'        => 1, //有效的
                            ]);
        }
        

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
            'card_status' => $this->card_status,
            'validity' => $this->validity,
            'reader_type_id' => $this->reader_type_id,
            'gender' => $this->gender,
            'deposit' => $this->deposit,
            'creditmoney' => $this->creditmoney,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'card_number', $this->card_number])
            ->andFilterWhere(['like', 'reader_name', $this->reader_name])
            ->andFilterWhere(['like', 'id_card', $this->id_card])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
