<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\HistoryPay $model */

$this->title = 'Create History Pay';
$this->params['breadcrumbs'][] = ['label' => 'History Pays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-pay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
