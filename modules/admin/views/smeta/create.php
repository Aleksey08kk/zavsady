<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Smeta $model */

$this->title = 'Создание сметы';
$this->params['breadcrumbs'][] = ['label' => 'Smetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smeta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
