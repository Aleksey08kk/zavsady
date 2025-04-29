<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Gas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'street_and_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'additionally')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gas_insurance')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
