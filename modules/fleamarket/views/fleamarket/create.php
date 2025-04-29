<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\Uslugi $model */
?>

<br><br><br>

<div class="uslugi-create container">
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['fleamarket/index']) ?>">Барахолка</a> > Создание объявления</span>
    <br><br>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>