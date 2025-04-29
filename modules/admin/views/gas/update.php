<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Gas $model */

$this->title = 'Update Gas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
