<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property string $title 名称
 * @property int $event_type 事件类型
 * @property string $description 内容
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
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
            [['event_type', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 128],
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
            'event_type' => '事件类型',
            'description' => '内容',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }


    static function getEventTypeOption($key=null)
    {
        $arr = array(
            1 => '通知公告',
            2 => '工作动态',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    static function getEventType($model)
    {
        return self::getEventTypeOption($model->event_type);
    }



}
