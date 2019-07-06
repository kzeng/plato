<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reading_room_checkin".
 *
 * @property int $id
 * @property int $reader_id 读者ID
 * @property string $card_number 读者证卡号
 * @property int $reading_room_id 阅览室ID
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class ReadingRoomCheckin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reading_room_checkin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reader_id', 'card_number', 'reading_room_id', 'library_id'], 'required'],
            [['reader_id', 'reading_room_id', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['card_number'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reader_id' => '读者ID',
            'card_number' => '读者证卡号',
            'reading_room_id' => '阅览室ID',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '签到时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }


    static function getReadingRoomOption($key=null)
    {
        $user = User1::findOne(['id' => Yii::$app->user->id]);
        $reading_rooms = ReadingRoom::find()->where(['library_id' => $user->library_id])->asArray()->all();    

        if(empty($reading_rooms))
        {
            $arr[0] = "未定义";
        }
        else
        {
            foreach ($reading_rooms as $reading_room) {
                $value = $reading_room['id'];
                $arr[$value] = "{$reading_room['title']}";
            }
        }

        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getReadingRoom($model)
    {
        return self::getReadingRoomOption($model->reading_room_id);
    }

    public function getReader()
    {
        return $this->hasOne(Reader::className(), ['id' => 'reader_id' ]);
    }


}
