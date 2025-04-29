<?php

use app\models\Gas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'История оплат за газ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать оплату за газ', ['create'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('Загрузить файл оплат за газ', ['upload-gas'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'street_and_num',
            'sum',
            'additionally',
            'gas_insurance',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
