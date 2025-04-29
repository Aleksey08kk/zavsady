<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use app\assets\LoginAsset;
use yii\helpers\Url;

LoginAsset::register($this);
?>

<br><br>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable" style="margin: 0;">
         <h4><i class="icon fa fa-check"></i>Регистрация прошла успешно</h4>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success-forget')): ?>
    <div class="alert alert-success alert-dismissable" style="margin: 0;">
         <h4><i class="icon fa fa-check"></i>Проверьте почту</h4>
         <?= Yii::$app->session->getFlash('success-forget') ?>
    </div>
<?php endif; ?>


<div class="container">
    <div class="screen">
        <div class="screen__content">
            <div class="login">

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'inputOptions' => ['class' => 'login__input']
                    ],
                ]); ?>
                <div class="login__field">

                    <?= $form->field($model, 'email')->textInput(['placeholder' => "Эл. почта"])->label(false) ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>

                    <?= $form->field($model, 'activate_cod')->passwordInput(['placeholder' => "Код из почты. 4 цифры"])->label(false) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
                <?= Html::submitButton('Войти', ['class' => 'button login__submit', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>

            </div>

            <a class="a reg" href="<?= Url::toRoute(['auth/signup']) ?>"> Нет аккаунта?<br>✎Зарегистрироваться </a>
            <a class="forget" href="<?= Url::toRoute(['auth/forget']) ?>"> Забыли пароль? </a>

        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>