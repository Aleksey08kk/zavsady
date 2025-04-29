<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BusinessOffer $model */

$this->title = 'Create Business Offer';
$this->params['breadcrumbs'][] = ['label' => 'Business Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-offer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
