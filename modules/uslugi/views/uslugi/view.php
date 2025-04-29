<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\Uslugi $model */

$this->title = $model->usluga;
$this->params['breadcrumbs'][] = ['label' => 'Uslugis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<br><br><br><br>
<div class="uslugi-view container">
<span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['uslugi/index']) ?>">ЗавСадУслуги</a> > <a href="<?= Url::toRoute(['uslugi/my-uslugi']) ?>">Мои ЗавСадУслуги</a> > <?= $model->usluga ?></span>
    <br><br>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'usluga',
            //'active',
            //'allow',
            'phone',
            'viber',
            //'photo',
            //'date',
        ],
    ]) ?>

</div>
<br><br><br>