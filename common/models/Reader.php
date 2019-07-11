<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "reader".
 *
 * @property int $id
 * @property string $card_number 卡号
 * @property int $card_status 证件状态
 * @property string $reader_name 姓名
 * @property int $validity 有效期限
 * @property string $id_card 身份证
 * @property int $reader_type_id 读者类型
 * @property int $gender 性别
 * @property string $deposit 押金(元)
 * @property string $creditmoney 欠费金额(元)
 * @property string $mobile 电话
 * @property string $address 地址
 * @property int $library_id 图书馆ID
 * @property int $user_id 操作员ID
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $status 状态
 */
class Reader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reader';
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
            [['card_number', 'reader_name', 'validity', 'id_card', 'reader_type_id', 'gender', 'library_id'], 'required'],
            [['card_status', 'validity', 'reader_type_id', 'gender', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['deposit', 'creditmoney'], 'number'],
            [['card_number', 'reader_name', 'id_card'], 'string', 'max' => 64],
            [['mobile', 'address'], 'string', 'max' => 32],
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
            'card_status' => '证件状态',
            'reader_name' => '姓名',
            'validity' => '有效期限',
            'id_card' => '身份证',
            'reader_type_id' => '读者类型',
            'gender' => '性别',
            'deposit' => '押金(元)',
            'creditmoney' => '欠费金额',
            'mobile' => '电话',
            'address' => '地址',
            'library_id' => '图书馆ID',
            'user_id' => '操作员ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }

    static function getCardStatusOption($key=null)
    {
        $arr = array(
            1 => '正常',
            0 => '挂失',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    static function getCardStatus($model)
    {
        if ($model->card_status)
            return "<span class=\"label label-success\">正常</span>";
        else
            return "<span class=\"label label-danger\">挂失</span>";
    }

    static function getGenderOption($key=null)
    {
        $arr = array(
            1 => '男',
            0 => '女',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }
    static function getGender($model)
    {
        return self::getGenderOption($model->gender);
    }

    
    
    static function getReaderTypeOption($key=null)
    {
        // if(Yii::$app->user->id == 1) //admin
        // {
        //     $reader_types = ReaderType::find()->asArray()->all();    
        // }
        // else
        // {
        //     $library_id = User1::getCurrentLibraryId(Yii::$app->user->id);
        //     $reader_types = ReaderType::find()->where(['id' => $library_id])->asArray()->all();    
        // }

        $reader_types = ReaderType::find()->asArray()->all();    

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

        
    public static function setCardStatusAjax($id,$card_status)
    {
        $reader = self::findOne(['id' => $id]);
        if(empty($reader))
        {
            //U::W("----------$reader is null--------");
            return \yii\helpers\Json::encode(['code' => 1]);
        }

        $reader->card_status = $card_status;
        $reader->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }

    public static function setCardNumberAjax($id,$card_number)
    {
        $reader = self::findOne(['id' => $id]);
        if(empty($reader))
        {
            //U::W("----------$reader is null--------");
            return \yii\helpers\Json::encode(['code' => 1]);
        }
        // 注意！
        // 此处应该有对该读者业务相关内容的判断
        // 如有欠款，有未还书籍，不允许换号，返回自定义错误码

        $reader->card_number = $card_number;
        $reader->save(false);
        return \yii\helpers\Json::encode(['code' => 0]);
    }





}
