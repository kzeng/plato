<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title 题名
* @property string $cover_img 封面
* @property string $description 简介
 * @property string $isbn ISBN
 * @property string $author 作者
 * @property string $price 价格(元)
 * @property string $class_number 分类号
 * @property string $call_number 索书号
 * @property int copy_number 副本数
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
            [['title', 'isbn', 'author', 'library_id'], 'required'],
            [['price'], 'number'],
            [['library_id', 'user_id', 'copy_number', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['cover_img'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
            [['isbn', 'author', 'class_number', 'call_number', 'publisher', 'publication_place', 'publish_date', 'series_title', 'price1'], 'string', 'max' => 64],
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
            'cover_img' => '封面',
            'description' => '简介',
            'isbn' => 'ISBN',
            'author' => '作者',
            'price' => '价格(元)',
            'price1' => '价格(元)',
            'copy_number' => '复本数',
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

    static function getCollectionPlace($id)
    {
        $book = Book::findOne(['id' => $id]);
        $collect_places = CollectionPlace::find()->where(['library_id' => $book->library_id])->all();

        $rep = "<select id=\"collect_place\" class=\"form-control\">";

        foreach($collect_places as $collect_place)
        {
            $rep = $rep."<option value=".$collect_place->id.">".$collect_place->title."</option>";
        }
        $rep = $rep."</select>";
        return $rep;
    }

    static function getBookseller($id)
    {
        $book = Book::findOne(['id' => $id]);
        $booksellers = Bookseller::find()->where(['library_id' => $book->library_id])->all();

        $rep = "<select id=\"bookseller\" class=\"form-control\">";

        foreach($booksellers as $bookseller)
        {
            $rep = $rep."<option value=".$bookseller->id.">".$bookseller->title."</option>";
        }
        $rep = $rep."</select>";
        return $rep;
    }

    static function getCirculationType($id)
    {
        $book = Book::findOne(['id' => $id]);
        $circulation_types = CirculationType::find()->where(['library_id' => $book->library_id])->all();

        $rep = "<select id=\"circulation_type\" class=\"form-control\">";

        foreach($circulation_types as $circulation_type)
        {
            $rep = $rep."<option value=".$circulation_type->id.">".$circulation_type->title."</option>";
        }
        $rep = $rep."</select>";
        return $rep;
    }


    public static function setAddBookCopyAjax($id, $copy_number, $bar_code, $price1, $price2, $collect_place, $circulation_type, $bookseller, $call_number)
    {
        $book = Book::findOne(['id' => $id]);

        if(!empty($book))
        {
            for($i = 1; $i <= $copy_number; $i++ )
            {
                $book_copy = new BookCopy();
                $book_copy->book_id       = $book->id;
                $book_copy->title       = $book->title;
                $book_copy->bar_code    = $bar_code;
                $book_copy->price1      = $price1;
                $book_copy->price2      = $price2;
                $book_copy->collection_place_id    = $collect_place;
                $book_copy->circulation_type_id    = $circulation_type;
                $book_copy->bookseller_id          = $bookseller;
                $book_copy->call_number_rules_id   = $call_number;
                $book_copy->library_id         = $book->library_id;
                $book_copy->user_id            = $book->user_id;
                $book_copy->save(false);
            }

            $book->copy_number = $book->copy_number + $copy_number;
            $book->save(false);

            return \yii\helpers\Json::encode(['code' => 0]);
        }
        else
        {
            return \yii\helpers\Json::encode(['code' => -1]);
        }
    }



    

}
