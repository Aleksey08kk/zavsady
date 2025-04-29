<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BusinessOffer $model */
/** @var yii\widgets\ActiveForm $form */
?>


<br><br><br>
<div class="form-flex">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'image')->fileInput(['maxlength' => true])->label('') ?>
    <div class="form-group">
        <?= Html::submitButton('отправить', ['class' => '']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>




