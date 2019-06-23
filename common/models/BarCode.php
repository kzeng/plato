<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bar_code".
 *
 * @property int $id
 * @property string $title 名称
 * @property string $prefix 前缀
 * @property int $number_length 数字长度
 * @property int $min_number 数字最小值
 * @property int $max_number 数字最大值
 * @property string $description 说明
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class BarCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bar_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'number_length', 'min_number', 'max_number', 'library_id'], 'required'],
            [['number_length', 'min_number', 'max_number', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['prefix'], 'string', 'max' => 64],
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
            'prefix' => '前缀',
            'number_length' => '数字长度',
            'min_number' => '数字最小值',
            'max_number' => '数字最大值',
            'description' => '说明',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
