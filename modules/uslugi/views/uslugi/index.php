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
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > ЗавСадУслуги</span>
    <br><br>



    <div class="nav-up">
        <h1 class="zagol">ЗавСадУслуги</h1>

        <div class="burger" id="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="menu" id="menu">
            <ul class="ul-nav-up">
                <li class="li-nav-up"><?= Html::a('Главная', ['../../'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Личный кабинет', ['../site/profile'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Предложить услугу', ['create'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Мои услуги', ['my-uslugi'], ['class' => 'a-nav-up']) ?></li>
            </ul>
        </nav>
    </div>





    <br><br>
    <?php foreach (array_reverse($uslugiModel) as $usluga) : ?>
        <div class="card">
            <p><strong><?= $usluga->usluga ?></strong></p>
            <p><?= $usluga->name ?></p>
            <?php if ($usluga->viber) : ?>
                <p class="btn btn-info"><a style="color: aliceblue;" href="https://t.me/+<?= $usluga->viber ?>" target="_blank">Написать в Телеграм</a></p>
            <?php endif; ?>
            <?php if ($usluga->phone) : ?>
                <p class="btn btn-success"><a style="color: aliceblue;" href="tel:+<?= $usluga->phone ?>">Позвонить</a></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <br><br><br>