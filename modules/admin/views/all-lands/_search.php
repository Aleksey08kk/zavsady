<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AllLandsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="all-lands-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'street_and_num') ?>

    <?= $form->field($model, 'name_owner') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'debt_str') ?>

    <?php // echo $form->field($model, 'debt_int') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
