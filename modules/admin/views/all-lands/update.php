<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AllLands $model */

$this->title = 'Update All Lands: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'All Lands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="all-lands-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
