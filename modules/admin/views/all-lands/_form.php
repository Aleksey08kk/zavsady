<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AllLands $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="all-lands-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'street_and_num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'how_much_sotok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accrual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debt_str')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dop_accrual')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput() ?>

    <?= $form->field($model, 'dop_two_accrual')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
