<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Qwestons $model */
/** @var ActiveForm $form */
?>
<br><br>

<style>
.site-qweston{
    width: 80%;
    margin: 100px auto;
}
</style>

<div class="site-qweston">

<h3>Связь с разработчиком</h3>
<p>Если вы нашли неточность в своих данных, или любую другую ошибку, сообщите нам и мы исправим.</p>
<br><br>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable" style="margin: 0;">
    <?= Yii::$app->session->getFlash('success') ?>
    <br>
         <h6><i class="icon fa fa-check"></i><a class="addfoto last3" href="<?= Url::toRoute(['profile']) ?>">Вернуться в личный кабинет</a></h6>
         
    </div>
<?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'qweston')->textarea(['class' => 'form-control', 'placeholder' => 'Ваше сообщение'])->label(false) ?>
                
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
