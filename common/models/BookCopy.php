<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "book_copy".
 *
 * @property int $id
 * @property int $book_id 图书ID
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
            [['title', 'bar_code', 'book_id', 'bookseller_id', 'collection_place_id', 'circulation_type_id', 'call_number_rules_id', 'library_id'], 'required'],
            [['bookseller_id', 'book_id', 'collection_place_id', 'circulation_type_id', 'call_number_rules_id', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'book_id' => '图书ID',
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

    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id' ]);
    }

    public function getBookseller()
    {
        return $this->hasOne(Bookseller::className(), ['id' => 'bookseller_id' ]);
    }

    public function getCollectionPlace()
    {
        return $this->hasOne(CollectionPlace::className(), ['id' => 'collection_place_id' ]);
    }

    public function getCirculationType()
    {
        return $this->hasOne(CirculationType::className(), ['id' => 'circulation_type_id' ]);
    }

    public function getCallNumberRules()
    {
        return $this->hasOne(CallNumberRules::className(), ['id' => 'call_number_rules_id' ]);
    }


}
