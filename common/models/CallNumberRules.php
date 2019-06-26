<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "call_number_rules".
 *
 * @property int $id
 * @property string $title 名称
 * @property string $collection_place_ids 馆藏地
 * @property string $circulation_type_ids 流通类型
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class CallNumberRules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'call_number_rules';
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
            [['collection_place_ids', 'circulation_type_ids'], 'string', 'max' => 512],
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
            'collection_place_ids' => '馆藏地',
            'circulation_type_ids' => '流通类型',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
