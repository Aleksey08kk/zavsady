<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $userModel = User::find()->where(['id' => Yii::$app->user->identity])->one();
        $mailStastus=0;
        if($userModel){
            $mailStastus = $userModel->mail_status;
        }
        

        return $this->render('login', [
            'model' => $model,
            'mailStastus' => $mailStastus,
        ]);
    }

    public function actionLoginPass()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $userModel = User::find()->where(['id' => Yii::$app->user->identity])->one();
        $mailStastus = 0;
        if ($userModel) {
            $mailStastus = $userModel->mail_status;
        }


        return $this->render('login-pass', [
            'model' => $model,
            'mailStastus' => $mailStastus,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionSignup()
    {
        $model = new SignupForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->signup())
            {
                Yii::$app->session->setFlash('success', "Вам на почту был отправлен код проверки. Введите его в соответствующее поле.<br /> Это потребуется только 1 раз");
                return $this->redirect(['auth/login']);
            }
        }
        Yii::$app->session->setFlash('success', "Введите адрес без 'ул.', запятых, точек и других лишних символов. Только улица и номер. Пример: Сливовая 12<br />Если в адресе присутствуют буквы, пишите их в нижнем регистре пример: Сливовая 12а<br />Если в адресе присутствует слеш(косая черта), пишите его как в этом примере: Сливовая 12/1<br /><br /> Далее вам на почту придет письмо с проверочным кодом который нужно ввести в соответствующее поле на странице входа.");
                
        return $this->render('signup', ['model'=>$model]);
    }

public function actionForget()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $userModel = User::find()->where(['email' => $model->email])->one();
            Yii::$app->mailer->compose()
                ->setTo($userModel->email)
                ->setFrom(['lialinaleksey08kk@yandex.ru' => 'СНТ Завьяловские сады'])
                ->setSubject('Восстановление пароля')
                ->setTextBody('Пароль')
                ->setHtmlBody('Ваш пароль: ' . $userModel->password . '<br>На странице входа поставьте галочку "Запомнить меня" чтоб остаться в системе. <br><br>Если пароль восстанавливаете не вы, советуем поменять пароль в настройках личного кабинета. <br><br>Письмо создано автоматически')
                ->send();
                Yii::$app->session->setFlash('success-forget', "Мы выслали письмо с паролем. <br /> Если письма нет, проверьте правильность написания почты " . $userModel->email);
                $userModel->txt = $userModel->txt + 1;
                $userModel->save(false);
                return $this->redirect(['auth/login']);
        }
        return $this->render('forget', [
            'model' => $model,
        ]);
    }
    
    
}