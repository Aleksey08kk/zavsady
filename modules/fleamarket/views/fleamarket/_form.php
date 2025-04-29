<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\FleaMarket $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uslugi-form container">
    
    <h1 class="zagol">Создание/изменение объявления</h1><br>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_customer')->textInput()->label('Ваше имя') ?>

    <?= $form->field($model, 'product')->textInput()->label('Название объявления') ?>

    <?= $form->field($model, 'content')->textarea()->label('Описание') ?>

    <?= $form->field($model, 'phone')->textInput()->label('Телефон для связи. Без "8". Это поле можно оставить пустым если не хотите звонков')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '79999999999',]); ?>

    <?= $form->field($model, 'viber')->textInput()->label('Впишите номер телефона привязаный к Телеграм. Без "8"')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '79999999999',]); ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить фото и выложить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<br><br><br><br>