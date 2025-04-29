<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\UslugiAsset;
use yii\widgets\ActiveForm;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\UslugiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(99588984, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/99588984" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div class="uslugi-index">
    <br><br><br><br>
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > Предложения от жителей</span>
    <br><br>



    <div class="nav-up">
        <div>
        <h1 class="zagol">Предложения от жителей</h1>
        <p>Ваши предложения и пожелания по улучшению жизни в нашем СНТ</p>
        </div>
        <div class="burger" id="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="menu" id="menu">
            <ul class="ul-nav-up">
                <li class="li-nav-up"><?= Html::a('Главная', ['../../'], ['class' => 'a-nav-up']) ?></li>
                <li class="li-nav-up"><?= Html::a('Создать предложение', ['create'], ['class' => 'a-nav-up']) ?></li>
            </ul>
        </nav>
    </div>


    <script>
        // Сохраняем положение скролла перед обновлением страницы
        window.addEventListener('beforeunload', function() {
            localStorage.setItem('scrollPosition', window.scrollY);
        });

        // Восстанавливаем положение скролла после загрузки страницы
        window.addEventListener('load', function() {
            const scrollPosition = localStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition, 10));
                localStorage.removeItem('scrollPosition'); // Удаляем значение после использования
            }
        });
    </script>



    <br><br>
    <?php foreach (array_reverse($suggestionsModel) as $suggestion) : ?>
        <div class="card">

            <h4><strong><?= Html::encode($suggestion->suggestion) ?></strong></h4>
            <p><?= Html::encode($suggestion->detailed) ?></p>
            <p>Комментарий: <?= $suggestion->comment ?></p>
            <p class="dates">Создано: <?= Html::encode(Yii::$app->formatter->asDate($suggestion->date_create)) ?></p>

            <br><br>
            <?php if (in_array($userModel->isAdmin, [1, 2])) : ?>
                <p>Автор предложения: <?= Html::encode($suggestion->name) . ", " . Html::encode($suggestion->address) ?></p>
                <hr><br>
                <div class="form-chenge">
                    

                    <?php if (Yii::$app->session->hasFlash('success' . $suggestion->id)): ?>
                        <div class="alert alert-success" id="success-alert">
                            <?= Yii::$app->session->getFlash('success' . $suggestion->id) ?>
                        </div>
                        <script>
                            setTimeout(function() {
                                var alert = document.getElementById('success-alert');
                                if (alert) {
                                    alert.style.display = 'none';
                                }
                            }, 5000); // 5000 миллисекунд = 5 секунд
                        </script>
                    <?php endif; ?>
                </div>

                <!-- Форма для комментария -->
                <div class="comment-form">
                <?php $formComment = ActiveForm::begin(['action' => ['comment', 'id' => $suggestion->id]]); ?>
                    <?= $formComment->field($suggestion, 'comment')->textarea(['rows' => 6]) ?>
                    <div class="form-comment">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>

                <!-- Форма для удаления предложения -->
                <?php $deleteForm = ActiveForm::begin(['action' => ['delete', 'id' => $suggestion->id], 'method' => 'post']); ?>
                <div class="form-delete">
                    <?= Html::submitButton('Удалить', [
                        'class' => 'btn-del-sugg',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить это предложение?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            <?php endif; ?>


        </div>
    <?php endforeach; ?>


    <br><br><br>
    </div>
    <!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=99588984&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/99588984/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="99588984" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->