<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\UslugiAsset;
use yii\helpers\Url;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\Uslugi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="uslugi-form container">
    
    <h1 class="zagol">Создание/изменение услуги</h1><br>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput()->label('Ваше имя') ?>

    <?= $form->field($model, 'usluga')->textInput()->label('Наименование услуги. Не более 7 слов.') ?>

    <p>Если не готовы к звонкам, укажите только Телеграм. Формат ввода 9992223344 без 8 и без 7 в начале.</p>

    <?= $form->field($model, 'phone')->textInput()->label('Телефон для связи. Без "8"')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '79999999999',]); ?>

    <?= $form->field($model, 'viber')->textInput()->label('Впишите номер телефона зарегистрированный в Телеграм. Без "8"')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '79999999999',]); ?>

    <div class="form-group">
        <?= Html::submitButton('Выложить услугу', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<p>Информация будет доступна только зарегистрированым пользователям СНТ Завьяловские сады.</p>

<br><br><br><br>