<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

/** @var app\models\Suggestions $model */

?>

<br><br><br><br>

<div class="suggestions-create container">

<span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > <a href="<?= Url::toRoute(['suggestions/index']) ?>">Предложения от населения</a> > Создание предложения</span>
    <br><br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<br><br>