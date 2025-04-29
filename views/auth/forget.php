<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */
/** @var ActiveForm $form */
?>
<div class="auth-forget container">

    <?php $form = ActiveForm::begin(); ?>
    <br><br><br><br><br>
    <h3>Восстановление пароля</h3>
    <br><br><br>
    <?= $form->field($model, 'email')->textInput(['placeholder' => "На какую почту была регистрация?"])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить пароль на почту', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <br><br><br><br><br><br><br><br>
</div><!-- auth-forget -->