<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $street;
    public $name;
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            [['name','email','password', 'street'], 'required', 'message'=>Yii::t('app', false)],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute'=>'email'],
        ];
    }

    public function signup(){
        if($this->validate()){
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}