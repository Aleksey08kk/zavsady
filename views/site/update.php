<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Обновить пользователя: ' . $model->name;
?>

<div class="container">
    <div class="user-update">
        <br><br>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>


        <br><br>
        <h6>Если у вас два и более участков, вы можете добавить их тут</h6><br>
        <a class="btn btn-success" href="<?= Url::toRoute(['site/add-land']) ?>">Добавить ещё адрес</a><br><br><br>


    </div>
</div>