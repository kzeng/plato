<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $access_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property string $mobile
 * @property int $library_id
 * @property int $user_id
 * @property int $pid
 */
class User1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
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
            [['username', 'auth_key', 'access_token', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'library_id', 'user_id', 'pid'], 'integer'],
            [['username', 'auth_key', 'access_token'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'verification_token', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'status' => '状态',
            'created_at' => '创建时间t',
            'updated_at' => '更新时间',
            'verification_token' => 'Verification Token',
            'mobile' => '电话',
            'library_id' => '分配至图书馆',
            'user_id' => 'User ID',
            'pid' => 'Pid',
        ];
    }

    static function getLibraryOption($key=null)
    {
        $libraries = Library::find()->asArray()->all();
        foreach ($libraries as $library) {
            $value = $library['id'];
            $arr[$value] = "{$library['title']}";
        }

        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getLibrary($model)
    {
        return self::getLibraryOption($model->library_id);
    }

    static function getCurrentLibraryId($user_id)
    {
        $user =  self::findOne(['id' => $user_id]);
        return $user->library_id;
    }
    
    static function getUser1Username($model)
    {
        $user =  self::findOne(['id' => $model->user_id]);
        return $user->username;
    }


    public function getLibraryModel()
    {
        return $this->hasOne(Library::className(), ['id' => 'library_id']);
    }
    


}
