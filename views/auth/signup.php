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
         <!--<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>-->
         <h4><i class="icon fa fa-check"></i>Правила регистрации:</h4>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('wrongaddress')): ?>
    <div class="alert alert-success alert-dismissable color-fon" style="margin: 0;">
         <h4><i class="icon fa fa-check"></i>Такого адреса у нас нет</h4>
         <?= Yii::$app->session->getFlash('wrongaddress') ?>
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
                    
                    <?= $form->field($model, 'street')->textInput(['placeholder' => "Улица и номер участка", 'autofocus' => true])->label(false); ?>

                    <?= $form->field($model, 'name')->textInput(['placeholder' => "ФИО"])->label(false); ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => "Эл.Почта"])->label(false) ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>
                </div>

                <?= Html::submitButton('Зарегистрироваться', ['class' => 'button login__submit', 'name' => 'login-button']) ?>
                
                <?php ActiveForm::end(); ?>
                
            </div>

            <a class="a regg" href="<?= Url::toRoute(['auth/login-pass']) ?>">Уже есть аккаунт?<br>Войти </a>
            

        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>


