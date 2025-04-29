<?php

use app\models\Fleamarket;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\FleamarketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="uslugi-index">
    <br><br><br><br>
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > Барахолка</span>
    <br><br>



    <div class="nav-up">
        <h1 class="zagol">Барахолка</h1>
        <div class="burger" id="burger">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </div>
        <nav class="menu" id="menu">
            <ul class="ul-nav-up">
                <li class="li-nav-up"><?= Html::a('Главная', ['../../'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Личный кабинет', ['../site/profile'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Разместить объявление', ['create'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Мои объявления', ['my-fleamarket'], ['class' => 'a-nav-up']) ?></li>
            </ul>
        </nav>
    </div>





    <br><br>
    <?php foreach (array_reverse($fleamarketModel) as $product) : ?>
        <div class="card">
            <h4><strong><?= $product->product ?></strong></h4>
            <h5><?= $product->content ?></h5>
            <img class="img-product" src="<?= $product->getImageUrl() ?>">
            <br>
            <p><?= $product->name_customer ?></p>
            <?php if ($product->viber) : ?>
                <p class="btn btn-info"><a style="color: aliceblue;" href="https://t.me/+<?= $product->viber ?>" target="_blank">Написать в Телеграм</a></p>
            <?php endif; ?>
            <?php if ($product->phone) : ?>
                <p class="btn btn-success"><a style="color: aliceblue;" href="tel:+<?= $product->phone ?>">Позвонить</a></p>
            <?php endif; ?>
            <p><?= Yii::$app->formatter->asDate($product->date, 'php:d m Y') ?></p>
        </div>
    <?php endforeach; ?>

    <br><br><br>