<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title 题名
 * @property string $isbn ISBN
 * @property string $author 作者
 * @property string $price 价格(元)
 * @property string $class_number 分类号
 * @property string $call_number 索书号
 * @property string $publisher 出版社
 * @property string $publication_place 出版地
 * @property string $publish_date 出版年月
 * @property string $series_title 从书名
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'isbn', 'author', 'library_id'], 'required'],
            [['price'], 'number'],
            [['library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['isbn', 'author', 'class_number', 'call_number', 'publisher', 'publication_place', 'publish_date', 'series_title'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '题名',
            'isbn' => 'ISBN',
            'author' => '作者',
            'price' => '价格(元)',
            'class_number' => '分类号',
            'call_number' => '索书号',
            'publisher' => '出版社',
            'publication_place' => '出版地',
            'publish_date' => '出版年月',
            'series_title' => '从书名',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
