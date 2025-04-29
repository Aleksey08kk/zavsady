<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AllLands $model */
/** @var ActiveForm $form */
?>

<br><br><br><br><br><br>
<div class="container">
<a href="<?= Url::toRoute(['profile']) ?>">Вернуться в личный кабинет</a><br><br><br>
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissable" style="margin: 0;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <div class="site-add-land">
        <p>Введите адрес без 'ул.', без запятых и других лишних знаков. Пример: Яблоневая 12</p>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'street_and_num')->textInput(['placeholder' => "Какой адрес хотите добавить?"])->label(false); ?>

        <div class="form-group">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
<br><br><br><br><br><br><br><br><br>