<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\UslugiAsset;
use app\models\User;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\Suggestions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="suggestions-form container">

<h1 class="zagol">Создание предложения</h1><br>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'value' => $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one()->street]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'value' => $userModel = User::find()->where(['id' => Yii::$app->user->identity->id])->one()->name]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'suggestion')->textInput(['maxlength' => true])->label('Заголовок предложения') ?>

    <?= $form->field($model, 'detailed')->textarea(['maxlength' => true])->label('Опишите подробнее') ?>

    
    <div class="form-group">
        <?= Html::submitButton('Выложить предложение', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

