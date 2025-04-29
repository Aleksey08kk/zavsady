<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Debts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="debts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'street_and_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debt')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
