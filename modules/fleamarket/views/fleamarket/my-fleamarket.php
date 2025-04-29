<?php

use app\models\Fleamarket;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\FleamarketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="uslugi-index">
    <br><br><br>
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['fleamarket/index']) ?>">Барахолка</a> > Мои объявления</span>
    <br><br>

    <div class="nav-up">
        <h1 class="zagol">Мои объявления</h1>
        <div class="burger" id="burger">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </div>
        <nav class="menu" id="menu">
            <ul class="ul-nav-up">
                <li class="li-nav-up"><?= Html::a('Назад', ['index'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Разместить объявление', ['create'], ['class' => 'a-nav-up']) ?></li>
            </ul>
        </nav>
    </div>


    <br><br>

    <?php foreach (array_reverse($myFleamarket) as $product) : ?>
        <div class="card">
            <h4><strong><?= $product->product ?></strong></h4>
            <h5><?= $product->content ?></h5>
            <img class="img-product" src="<?= $product->getImageUrl() ?>">
            <br>
            <p>Дата создания: <?= Yii::$app->formatter->asDate($product->date, 'php:d m Y') ?></p>

            <p class="btn btn-success"><a style="color: aliceblue;" href="<?= Url::toRoute(['update', 'id' => $product->id]) ?>">Изменить</a></p>
            <p class="btn btn-danger" style="display: flex; align-items: center; justify-content: center; height: 40px;">
                <?= Html::a('Удалить', ['delete', 'id' => $product->id], [
                    'class' => 'btn',
                    'style' => 'color: aliceblue;',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот товар?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>


        </div>
    <?php endforeach; ?>

    <br><br><br>
</div>