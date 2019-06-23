<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reader_type".
 *
 * @property int $id
 * @property string $title 名称
 * @property int $max_borrowing_number 最大借阅量（本）
 * @property int $max_debt_limit 最大欠费额度（元）
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class ReaderType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reader_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'max_borrowing_number', 'max_debt_limit', 'library_id'], 'required'],
            [['max_borrowing_number', 'max_debt_limit', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'max_borrowing_number' => '最大借阅量（本）',
            'max_debt_limit' => '最大欠费额度（元）',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
