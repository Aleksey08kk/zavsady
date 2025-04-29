<?php

use app\models\Uslugi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\UslugiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="uslugi-index">
    <br><br><br><br>
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['uslugi/index']) ?>">ЗавСадУслуги</a> > Мои ЗавСадУслуги</span>
    <br><br>
    <div class="nav-up">
        <h1 class="zagol">Мои ЗавСадУслуги</h1>


        <div class="burger" id="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="menu" id="menu">
            <ul class="ul-nav-up">
                <li class="li-nav-up"><?= Html::a('Назад', ['index'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Предложить ещё услугу', ['create'], ['class' => 'a-nav-up']) ?></li>
            </ul>
        </nav>
    </div>
    <br><br>

    <div style="background-color: white; overflow: hidden;">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'usluga',
                [
                    'attribute' => 'name',
                    'label' => 'Имя',
                    'filter' => false,
                    'headerOptions' => ['class' => 'hidd-for-phone'],
                    'contentOptions' => ['class' => 'hidd-for-phone'],
                ],
                [
                    'attribute' => 'phone',
                    'format' => 'raw',
                    'label' => 'Позвонить',
                    'headerOptions' => ['class' => 'hidd-for-phone'],
                    'contentOptions' => ['class' => 'hidd-for-phone'],
                    'filter' => false,
                    'value' => function ($model) {
                        return Html::a($model->phone, Url::to('tel:+' . $model->phone, true));
                    },
                ],
                [
                    'attribute' => 'viber',
                    'format' => 'raw',
                    'label' => 'Написать в viber',
                    'filter' => false,
                    'value' => function ($model) {
                        return Html::a($model->viber, Url::to('viber://chat?number=%2B' . $model->viber, true));
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Uslugi $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]);
        ?>
    </div>

    <br><br><br>
</div>