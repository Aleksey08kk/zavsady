<?php

use app\models\HistoryPay;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\HistoryPaySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'История платежей';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .pagination a{
        margin: 0 15px;
    }
</style>

<div class="history-pay-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
    <?= Html::a('Загрузить .txt файл из сбербанка', ['upload-txt-sber'], ['class' => 'btn btn-primary']) ?>
    </p>-->
    <?= Html::a('Создать оплату', ['create'], ['class' => 'btn btn-success']) ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'when_date',
            'address',
            'name',
            'sum',
            //'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HistoryPay $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
