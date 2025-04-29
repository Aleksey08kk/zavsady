<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AllLands $model */

$this->title = 'Создать участок';
$this->params['breadcrumbs'][] = ['label' => 'All Lands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-lands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
