<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['title', 'max_borrowing_number', 'max_debt_limit', 'max_return_time', 'library_id'], 'required'],
            [['max_borrowing_number', 'max_debt_limit', 'max_return_time', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
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
            'max_return_time' => '最大还书时间',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }

    
    static function getReaderTypeOption($key=null)
    {
        if(Yii::$app->user->id == 1) //admin
        {
            $reader_types = ReaderType::find()->asArray()->all();    
        }
        else
        {
            $library_id = User1::getCurrentLibraryId(Yii::$app->user->id);
            $reader_types = ReaderType::find()->where(['id' => $library_id])->asArray()->all();    
        }

        if(empty($reader_types))
        {
            $arr[0] = "未定义";
        }
        else
        {
            foreach ($reader_types as $reader_type) {
                $value = $reader_type['id'];
                $arr[$value] = "{$reader_type['title']}";
            }
        }

        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    static function getReaderType($model)
    {
        return self::getReaderTypeOption($model->reader_type_id);
    }

    // static function ReaderType($model)
    // {
    //     return self::getReaderTypeOption($model->library_id);
    // }
}
