<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_of_debt".
 *
 * @property int $id
 * @property string $card_number 卡号
 * @property string $reader_name 姓名
 * @property int $violation_type_id 违章类型
 * @property int $payment_status 缴费状态
 * @property string $penalty 罚金(元)
 * @property string $description 描述
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class PaymentOfDebt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_of_debt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_number', 'reader_name', 'violation_type_id', 'payment_status', 'description', 'library_id'], 'required'],
            [['violation_type_id', 'payment_status', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['penalty'], 'number'],
            [['card_number', 'reader_name'], 'string', 'max' => 64],
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
            'card_number' => '卡号',
            'reader_name' => '姓名',
            'violation_type_id' => '违章类型',
            'payment_status' => '缴费状态',
            'penalty' => '罚金(元)',
            'description' => '描述',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}
