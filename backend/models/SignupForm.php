<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    
     /**
     * @var UploadedFile[]
     */
    
    public $firstname;
    public $surname;
    public $phone;
    public $email;
    public $role;
    public $password;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','surname','phone','role'], 'required'],
            [['firstname', 'surname', 'role'], 'string', 'max' => 255],
            ['phone','number'],   
            ['phone','string','max' => 10,'min' => 10],     
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' => 'create'],
            // ['password', 'required'],
            // ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    



    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        // var_dump($this->signature->baseName);
        // exit;
        if (!$this->validate()) {
            return null;
        }

        
        $user = new User();
        $user->firstname = $this->firstname;
        $user->surname = $this->surname;
        $user->role = $this->role;
        $user->status = 10;
        $user->phone = $this->phone;
        $user->email = $this->email;
        // $user->setDefaultPassword($this->email);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->generatePasswordResetToken();
        

        return $user->save() && $this->setPasswordEmail($user);
    }

    public function updateUser($id)
    {
        var_dump($this->firstname);
        exit;
        
        if (!$this->validate()) {
            return null;
        }

        
        $user = User::findOne($id);
        $user->firstname = $this->firstname;
        $user->surname = $this->surname;
        $user->role = $this->role;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->status = 10;
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        

        return $user->save();
    }

    public static function findUser($id){
        return User::findOne($id);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' Administrator'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function setPasswordEmail($user)
    {
            return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' Administrator'])
            ->setTo($this->email)
            ->setSubject('Password set at ' . Yii::$app->name)
            ->send();
    }
}
