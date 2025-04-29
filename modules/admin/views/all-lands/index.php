<?php

use app\models\AllLands;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AllLandsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Все участки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-lands-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать участок', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Загрузить .txt файл из сбербанка', ['upload-txt-sber'], ['class' => 'btn btn-primary']) ?>
        <span onClick="alert('Подтверждение обновления долгов')"><?= Html::a('Вычесть из долгов и записать в историю оплат', ['default/rec-debt'], ['class' => 'btn btn-success']) ?></span>
        <span onClick="alert('Подтверждение обновления доп взносов')"><?= Html::a('Доп взносы вычесть и записать в историю оплат', ['default/rec-dop-debt'], ['class' => 'btn btn-success']) ?></span>
        <span onClick="alert('Подтверждение записи оплат за газ')"><?= Html::a('Записать оплаты за газ', ['default/rec-gas'], ['class' => 'btn btn-info']) ?></span>

        <br><br>
        <span onClick="alert('Подтвердить отправку писем?')"><?= Html::a('Отправить письма с долгами', ['send-mail'], ['class' => 'btn btn-primary']) ?></span>
        <!--<span onClick="alert('Подтвердить?')"><?= Html::a('Загрузить все участки', ['upload-all'], ['class' => 'btn btn-success']) ?></span>-->
        <span onClick="alert('Начислить взносы прямо сейчас?')"><?= Html::a('Начислить взносы', ['make-contributions'], ['class' => 'btn btn-success']) ?></span>
        <?= Html::a('Обнулить начисления и долги', ['make-null'], ['class' => 'btn btn-primary']) ?>
        <span onClick="alert('Начислить доп взносы прямо сейчас?')"><?= Html::a('Дополнительные взносы взносы в dop_accrual', ['make-dop-contributions'], ['class' => 'btn btn-success']) ?></span>
     
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'street_and_num',
            'how_much_sotok',
            'accrual',
            'debt_str',
            'dop_accrual',
            'name_owner',
            'email:email',
            'tel',
            'dop_two_accrual',
            //'photo',
            //'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AllLands $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
