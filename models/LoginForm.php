<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $activate_cod;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['activate_cod', 'validateActivateCod'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            //'username' => Yii::t('app', 'USER_USERNAME'),
            //'password' => Yii::t('app', 'USER_PASSWORD'),
            'rememberMe' => Yii::t('app', 'Запомнить меня'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Не правильная почта или пароль');
            }
        }
    }

    public function validateActivateCod($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validateActivateCod($this->activate_cod)) {
                $this->addError($attribute, 'Не верный код.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     * @return bool whether the user is logged in successfully
     */
    public function login(): bool
    {
        $emainClean = str_replace(' ', '', $this->email);
        if ($this->validate()) {
            $userModel = User::findByEmail($emainClean);
            $userModel->mail_status = 1;
            $userModel->save(false);

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User
     */
    public function getUser(): User
    {
        $emainClean = str_replace(' ', '', $this->email);
        if ($this->_user === false) {
            $this->_user = User::findByEmail($emainClean);
        }

        return $this->_user;
    }
}
