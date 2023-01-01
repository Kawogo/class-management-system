<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $surname
 * @property string $firstname
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string $role
 * @property int $phone
 */
class User extends \yii\db\ActiveRecord
{
     /**
     * @var UploadedFile[]
     */
    // public $new;
    // public $signature;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'firstname','email','role', 'phone'], 'required'],
            [['surname', 'firstname','role'], 'string', 'max' => 255],
            ['phone','integer'],
            ['phone','string','max' => 10,'min' => 10],
            // [['email'],'trim','required','string','on' => 'update'], 
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'firstname' => 'Firstname',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'role' => 'role',
            'phone' => 'Phone',
        ];
    }


    
    public static function setTime(){

        date_default_timezone_set("Africa/Dar_es_Salaam");
        $date = date('d-m-Y H:i');
        $timestamp = strtotime($date);
        return $timestamp;

    }

    public static function getTime($timestamp){
        if ($timestamp) {
            date_default_timezone_set("Africa/Dar_es_Salaam");
            $time = date('Y-m-d H:i:s',$timestamp);
            return $time; 
        }
        return '';
    
    }

    
}
