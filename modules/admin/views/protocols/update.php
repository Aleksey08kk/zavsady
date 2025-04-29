<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Protocols $model */

$this->title = 'Изменить протокол: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Protocols', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="protocols-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
