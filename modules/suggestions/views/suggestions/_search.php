<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SuggestionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="suggestions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'suggestion') ?>

    <?php // echo $form->field($model, 'under_consideration') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <?php // echo $form->field($model, 'cancelled') ?>

    <?php // echo $form->field($model, 'cancelled_reason') ?>

    <?php // echo $form->field($model, 'in_process') ?>

    <?php // echo $form->field($model, 'postponed') ?>

    <?php // echo $form->field($model, 'postponed_reason') ?>

    <?php // echo $form->field($model, 'completed') ?>

    <?php // echo $form->field($model, 'modification') ?>

    <?php // echo $form->field($model, 'date_last_update') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
