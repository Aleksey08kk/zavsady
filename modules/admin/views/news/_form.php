<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\News $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => "Только 2 слова для заголовка"]) ?>

    <?= $form->field($model, 'content', ['inputOptions' => ['id' => 'textarea']])->textarea(['class' => 'contentinput', 'maxlength' => true, 'placeholder' => "Содержание"]) ?>
    
    <?= $form->field($model, 'views')->textInput(['maxlength' => true, 'placeholder' => "0 - новая, 1 - старыя запись"]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>