<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Suggestions $model */

$this->title = 'Update Suggestions: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Suggestions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="suggestions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
