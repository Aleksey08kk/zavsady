<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\FleaMarket $model */
?>

<br><br><br><br>
<div class="uslugi-update container">
<span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['fleamarket/index']) ?>">Барахолка</a> > <a href="<?= Url::toRoute(['fleamarket/my-fleamarket']) ?>">Мои объявления</a> > Изменить: <?= $model->product ?></span>
<br><br>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>