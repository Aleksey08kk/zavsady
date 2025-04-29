<?php

namespace app\models;

use app\models\AllLands;
use SplFileInfo;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 * @property string $photo
 * @property string $mail_status
 * @property int $activate_cod
 * @property int $date
 * @property int $auth_key
 * @property string $street
 * @property int $land_num
 * @property string $debt
 * @property string $telephone
 * @property string $txt
 * 
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
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
            [['name', 'last_name', 'email', 'password', 'isAdmin', 'photo', 'mail_status'], 'required'],
            [['isAdmin', 'activate_cod', 'auth_key', 'debt'], 'integer', 'max' => 20],
            [['name'], 'string', 'max' => 20],
            [['last_name'], 'string', 'max' => 30],
            [['email', 'password'], 'string', 'max' => 50],
            [['photo'], 'string', 'max' => 500],
            [['mail_status'], 'string', 'max' => 5],
            [['street', 'land_num', 'telephone', 'txt'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Email',
            'password' => 'Пароль',
            'isAdmin' => 'Админ',
            'photo' => 'Фото',
            'mail_status' => 'Статус почты',
            'telephone' => 'Номер телефона',
            'debt' => 'Долг',
            'street' => 'Адрес',
            'activate_cod' => 'Код из почты',
        ];
    }

    public static function findIdentity($id): User
    {
        return User::findOne($id);
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByEmail(String $email): \yii\db\ActiveRecord
    {
        $user = User::find()->where(['email' => $email])->one();
        if ($user === null) {
            echo '<div style="text-align: center;"><img style="text-align: center; width: 360px" src="../img/noadd.png"><br><a href="login">Вернуться</a></div>';die;
        }
        return User::find()->where(['email'=>$email])->one();
    }

    public function validatePassword(String $password): bool
    {
        return $this->password == $password;
    }

    public function validateActivateCod(String $activate_cod): bool
    {
        return $this->activate_cod == $activate_cod;
    }

    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    public function create(): bool
    {
        $allLandsModel = AllLands::find()->where(['street_and_num' => $this->street])->one();
        if ($allLandsModel->street_and_num == $this->street) {
            $allLandsModel->email = $this->email;
            $allLandsModel->name_owner = $this->name;
            $allLandsModel->save(false);

            $code = rand(1231, 7879);
            Yii::$app->mailer->compose()
                ->setTo($this->email)
                ->setFrom(['lialinaleksey08kk@yandex.ru' => 'СНТ Завьяловские сады'])
                ->setSubject('Код подтверждения')
                ->setTextBody('Код для подтверждения почты')
                ->setHtmlBody($code . ' Код для подтверждения почты. Введите его в соответствующее поле при входе на сайт.<br /> Это потребуется только 1 раз. <br /><br /> Письмо создано автоматически.')
                ->send();
            $this->activate_cod = $code;

            return $this->save(false);
        }
        Yii::$app->session->setFlash('wrongaddress', "Проверьте правильность написания. Смотрите правила регистрации");
                return false;
    }

    public function saveUser()
    {
            return $this->save(false);
    }


    public function saveImagee($filename)
    {
        $info = new SplFileInfo($filename);
        if($info->getExtension() == "xlsx"){
            return true;
        }
        $this->photo = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        return ($this->photo) ? '/uploads/' . $this->photo : '../img/sad.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpLoad();
        $imageUploadModel->deleteCurrentImage($this->photo);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

}
