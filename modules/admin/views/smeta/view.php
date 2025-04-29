<?php

use app\models\BusinessOffer;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Smeta $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Smetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="smeta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Загрузить файл сметы', ['upload-smeta', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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
            'title',
            'description',
            'file',
            'date',
        ],
    ]) ?>

</div>


<h1>Коммерческие предложения для: <?= Html::encode($this->title) ?></h1>
<?= Html::a('Загрузить коммерческие предложения', ['business-offer/upload-bus-offer', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

<?php foreach ($offers as $offer) : ?>
    <div class="card mt-3">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
          <span class="text-secondary">Коммерческое <?= $offer->title ?></span>
          <?= $offer->file ?>
        </li>
      </ul>
    </div>
  <?php endforeach; ?>
  