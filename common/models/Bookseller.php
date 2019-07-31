<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "bookseller".
 *
 * @property int $id
 * @property string $title 公司名称
 * @property string $address 地址
 * @property string $contact 联系人姓名
 * @property string $mobile 电话
 * @property string $discount 折扣
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Bookseller extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookseller';
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
            [['discount'], 'number'],
            [['library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'address', 'contact'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '公司名称',
            'address' => '地址',
            'contact' => '联系人姓名',
            'mobile' => '电话',
            'discount' => '折扣',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
