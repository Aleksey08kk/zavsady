<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FleaMarket $model */

$this->title = 'Update Flea Market: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Flea Markets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="flea-market-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
