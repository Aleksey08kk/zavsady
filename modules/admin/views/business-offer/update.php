<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BusinessOffer $model */

$this->title = 'Изменить коммерческое предложение: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Business Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-offer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
