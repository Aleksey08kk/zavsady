<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FleaMarket $model */

$this->title = 'Создание объявления';
$this->params['breadcrumbs'][] = ['label' => 'Flea Markets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flea-market-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
