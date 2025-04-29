<?php

use app\models\BusinessOffer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BusinessOfferSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Коммерческие предложения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-offer-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--
    <p>
        <?= Html::a('Создать предложение', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'which_smeta',
            'title',
            'description',
            'file',
            'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BusinessOffer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
