<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\FleaMarket $model */

$this->title = $model->product;
\yii\web\YiiAsset::register($this);
?>

<br><br><br><br>
<div class="uslugi-view container">
<span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['fleamarket/index']) ?>">Барахолка</a> > <a href="<?= Url::toRoute(['fleamarket/my-fleamarket']) ?>">Мои объявления</a> > <?= $model->product ?></span>
    <br><br>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a('Добавить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
       <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name_customer',
            'product',
            'content',
            //'active',
            //'allow',
            'phone',
            'viber', //в базе колонка называется вибер но записывается туда строка с номером телефона привязаного в телегам
            [
                'format' => 'html',
                'label' => 'img',
                'value' => function($data){
                   return Html::img($data -> getImageUrl(), ['width'=>200]);
                }
            ],
            'date',
        ],
    ]) ?>

<?= Html::a('Готово', ['fleamarket/index'], ['class' => 'btn btn-success']) ?>

</div>
<br><br><br>