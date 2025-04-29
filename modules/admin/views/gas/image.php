<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Docs $model */
/** @var yii\widgets\ActiveForm $form */
?>


<br><br><br>
<div class="form-flex">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'image')->fileInput(['maxlength' => true])->label('') ?>
    <div class="form-group">
        <?= Html::submitButton('отправить', ['class' => 'pink-btn c-btn']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>




