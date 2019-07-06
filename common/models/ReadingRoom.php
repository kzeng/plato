<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "reading_room".
 *
 * @property int $id
 * @property string $title 名称
 * @property string $description 说明
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class ReadingRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reading_room';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'library_id'], 'required'],
            [['library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '名称',
            'description' => '说明',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }


    public static function setCheckinAjax($card_number,$library_id,$reading_room_id,$user_id)
    {
        $reader = Reader::findOne(['card_number' => $card_number]);
        if(empty($reader))
        {
            //U::W("----------$reader is null--------");
            return \yii\helpers\Json::encode(['code' => 1]);
        }

        $reading_room_checkin = new ReadingRoomCheckin();

        $reading_room_checkin->reader_id = $reader->id;
        $reading_room_checkin->card_number = $card_number;
        $reading_room_checkin->reading_room_id = $reading_room_id;
        $reading_room_checkin->library_id = $library_id;
        $reading_room_checkin->user_id = $user_id;
        $reading_room_checkin->created_at = time();
        $reading_room_checkin->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }


}
