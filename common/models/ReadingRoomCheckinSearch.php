<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ReadingRoomCheckin;

/**
 * ReadingRoomCheckinSearch represents the model behind the search form of `common\models\ReadingRoomCheckin`.
 */
class ReadingRoomCheckinSearch extends ReadingRoomCheckin
{
    public $created_at_range; 

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reading_room_id', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['card_number', 'reader_id', 'created_at_range'], 'safe'],
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
        $query = ReadingRoomCheckin::find()->orderBy([
            'id' => SORT_DESC,
        ]);

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

        if(!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
			list($start_date, $end_date) = explode(' - ', $this->created_at_range);
			$query->andFilterWhere(['between', 'reading_room_checkin.created_at', strtotime($start_date.' 00:00:01'), strtotime($end_date. '23:59:59')]);
        }	
        
        $query->joinWith('reader');
 
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'reading_room_id' => $this->reading_room_id,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'card_number', $this->card_number])
              ->andFilterWhere(['like', 'reader.reader_name', $this->reader_id]);

        return $dataProvider;
    }
}
