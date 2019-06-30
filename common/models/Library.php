<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "library".
 *
 * @property int $id
 * @property string $title 名称
 * @property string $mobile 电话
 * @property string $address 地址
 * @property int $user_id 操作员ID
 * @property int $pid 父ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Library extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'library';
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
            [['title'], 'required'],
            [['user_id', 'pid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'address'], 'string', 'max' => 128],
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
            'title' => '名称',
            'mobile' => '电话',
            'address' => '地址',
            'user_id' => '操作员ID',
            'pid' => '父ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }

    
    static function getLibraryTitle($model)
    {
        $library =  self::findOne(['id' => $model->library_id]);
        return $library->title;
    }
    

    


}
