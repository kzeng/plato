<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book_copy".
 *
 * @property int $id
 * @property string $title 题名
 * @property string $bar_code 条码号
 * @property int $bookseller_id 书商
 * @property string $price1 实洋(元)
 * @property string $price2 码洋(元)
 * @property int $collection_place_id 馆藏地
 * @property int $circulation_type_id 流通类型
 * @property int $call_number_rules_id 索书号规则
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class BookCopy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_copy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'bar_code', 'bookseller_id', 'collection_place_id', 'circulation_type_id', 'call_number_rules_id', 'library_id'], 'required'],
            [['bookseller_id', 'collection_place_id', 'circulation_type_id', 'call_number_rules_id', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['price1', 'price2'], 'number'],
            [['title', 'bar_code'], 'string', 'max' => 128],
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
            'bar_code' => '条码号',
            'bookseller_id' => '书商',
            'price1' => '实洋(元)',
            'price2' => '码洋(元)',
            'collection_place_id' => '馆藏地',
            'circulation_type_id' => '流通类型',
            'call_number_rules_id' => '索书号规则',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
