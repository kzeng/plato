<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "borrow_return_books".
 *
 * @property int $id
 * @property int $reader_id 名称
 * @property string $card_number 卡号
 * @property string $bar_code 条码号
 * @property int $operation 借还操作:1借，0还
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class BorrowReturnBooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrow_return_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reader_id', 'card_number', 'bar_code', 'operation', 'library_id'], 'required'],
            [['reader_id', 'operation', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['card_number'], 'string', 'max' => 64],
            [['bar_code'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reader_id' => '名称',
            'card_number' => '卡号',
            'bar_code' => '条码号',
            'operation' => '借还操作:1借，0还',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
    

    public static function getReaderInfoAjax($ardnumber_or_barcode)
    {
        $reader = Reader::findOne(['card_number' => $ardnumber_or_barcode]);

        if(empty($reader))
        {
            return \yii\helpers\Json::encode(['code' => -1]);
        }
        else
        {

            return \yii\helpers\Json::encode(['code' => 0, 'reader' => $reader]);
        }
        
    }

    public function getTReader()
    {
        return $this->hasOne(Reader::className(), ['id' => 'reader_id' ]);
    }

}
