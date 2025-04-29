<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HistoryPay $model */

$this->title = 'Update History Pay: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'History Pays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="history-pay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
