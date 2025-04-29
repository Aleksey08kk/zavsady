<?php

use app\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

IndexAsset::register($this);
?>



<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(m, e, t, r, i, k, a) {
    m[i] = m[i] || function() {
      (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    for (var j = 0; j < document.scripts.length; j++) {
      if (document.scripts[j].src === r) {
        return;
      }
    }
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  })
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  ym(98078758, "init", {
    clickmap: true,
    trackLinks: true,
    accurateTrackBounce: true,
    webvisor: true
  });
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/98078758" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!-------------------------------------------- Навигация --------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<header>
  <div class="logo"><img width="50px" src="/img/logo.png" alt=""> СНТСН Завьяловские сады</div>
  <nav>
    <ul class="nav-links">
      <?php if (!Yii::$app->user->isGuest) : ?>
        <li><a class="a-nav" href="<?= Url::toRoute(['site/profile']) ?>">Моя страница</span></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['/suggestions/suggestions/index']) ?>">Предложения</a></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['/uslugi/uslugi/index']) ?>">ЗавСадУслуги</a></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['/fleamarket/fleamarket/index']) ?>">Барахолка</a></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['site/cams']) ?>">Камеры</a></li>
        <li><a class="a-nav" href="#openModal">Выйти</a></li>
      <?php endif; ?>
      <?php if (Yii::$app->user->isGuest) : ?>
        <li><a class="a-nav" href="<?= Url::toRoute(['auth/signup']) ?>">Регистрация/Вход</a></li>
      <?php endif; ?>
    </ul>
    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
    <div class="exit" id="menu-exit">
      <span class="exit-bar"></span>
      <span class="exit-bar"></span>
    </div>
  </nav>
</header>
<!---------------------------------------------------------------------------------------------------------->
<br><br>
<div class="newslink">
  <div class="flex">
    <img class="imgsad" src="/img/sad.png">
    <div class="opis">
      <h1 class="title">Уважаемые Собственники!</h1>
      <br>
      <?php if (Yii::$app->user->isGuest) : ?>
        <h2 class="con">Приветствуем Вас на официальном сайте нашего СНТСН "Завьяловские сады". <br /><br />
          Доступ к разделам сайта будет предоставлен после регистрации. Нажмите ≡ в правом верхнем углу.</h2>
      <?php endif; ?>
      <?php if (!Yii::$app->user->isGuest) : ?>
        <h2 class="con">Приветствуем Вас на официальном сайте нашего СНТСН "Завьяловские сады". <br /><br />
          Вся необходимая информация о нашем СНТ в одном месте!
          Содержание будет постоянно пополняться.</h2>
      <?php endif; ?>
    </div>
  </div>
</div>




<!---------------------------------------------- Автобус ---------------------------------------------------->
<!--
<div id="bus" class="container ras">
  <h3 class="addfoto last3"><img class="imgh" src="img/sadderevo.png">Автобус<img class="imgh" src="img/sadderevo.png"></h3>
  <p class="busfromcity"><img class="warni" src="img/warni.svg" alt="">Время выезда указано из города от остановки "Ваш дом" из кармана.</p>
  <p class="busfromcity"><img class="warni" src="img/warni.svg" alt="">До какого месяца ездит автобус?. Перевозчик будет смотреть на погодные условия.</p>
  <img data-enlargeable style="cursor: zoom-in" class="raspi" src="../img/busOsen.jpg" alt="">
  <img data-enlargeable style="cursor: zoom-in" class="raspi" src="../img/busNum.jpg" alt="">
  <p>нажмите на фото чтоб увеличить</p>
</div>
  
<div id="bus" class="container ras">
  <h3 class="addfoto last3"><img class="imgh" src="img/sadderevo.png">Автобус<img class="imgh" src="img/sadderevo.png"></h3>
  <p class="busfromcity">Уважаемые садоводы и огородники!<br>
С 14.10.2024 г. закрывается сезонный автобусный маршрут.<br>
Поздравляем с окончанием сезона 2024 и ждем в следующем сезоне 2025!!!</p>
  <img data-enlargeable style="cursor: zoom-in" class="raspi" src="../img/busend.jpg" alt="">
</div>
-->
<br><br>

<!--------------------------------------------- Новости ---------------------------------------------------->
<?php if (!Yii::$app->user->isGuest) : ?>
  <h3 class="addfoto last3"><img class="imgh" src="img/sadh.png">Новости<img class="imgh" src="img/sadh.png"></h3>
  <br>

  <section class="container">
    <?php foreach (array_reverse($newsModel) as $news) : ?>
      <blockquote>
        <h3><?= $news->title ?></h3>
        <?= $news->content ?>
        <br>
        <?php if ($news->photo) : ?>
          <img class="newsfoto" src="<?= $news->getImage(); ?>">
        <?php endif; ?>
      </blockquote>
    <?php endforeach; ?>
    <?php if (!$news) : ?>
      <p>Пока нет актуальных новостей</p>
    <?php endif; ?>
    <a class="arhiv" href="<?= Url::toRoute(['old-news']) ?>">Открыть архив новостей</a>
  </section>
<?php endif; ?>

<!---------------------------------------- Модальное выйти? ---------------------------------------------------->

<div id="openModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Выйти из аккаунта?</h3>
      </div>
      <div class="modal-body">
        <a class="exit-answer" style="margin: 0 100px 0 0;" href="<?= Url::toRoute(['/auth/logout']) ?>">Да</a>
        <a class="exit-answer" href="/" title="Close" class="close">Нет</a>
      </div>
    </div>
  </div>
</div>
<!---------------------------------------- камеры --------------------------------------------------->
<!-- <a href="https://rtsp.me" title='RTSP.ME - Free website RTSP video steaming service' target="_blank">rtsp.me</a> -->
<!-- https://rtsp.me/ru/edit/RsbG9BRd сайт где делать ссылки  -->
<!-- rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=19&subtype=0 ссылка на камеры
 
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=4&subtype=0 ворота
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=11&subtype=0 мусорки
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=9&subtype=0 детская площадка




<h3 class="addfoto last3"><img class="imgh" src="img/sadh.png">Камеры<img class="imgh" src="img/sadh.png"></h3>
<br>

<div class="cams">
  <div>
    <?php
    $time = time() + 600;
    $token = str_replace("=", "", strtr(base64_encode(hash('sha256', 'a5ad3c9b9c8063dc4d8dccbd6ff3e82fbf1e79aae6fc163a8df7493c55be4870' . $time, true)), "+/", "-_"));
    echo "<iframe width='340' height='190' src='https://rtsp.me/private/432264/{$token}/{$time}/' frameborder='0'  title='RTSP стриминговый плеер' allowfullscreen>
Iframes не поддерживается. Трансляция  <a href='https://rtsp.me/ru/' title = 'rtsp streaming'>RTSP.me</a> сервис</iframe>";
    ?>
  </div>

  <div></div>

  <div></div>
</div>
-->






<!---------------------------------------- фото ---------------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<br>
<div class="fotos">
  <h3 class="addfoto last3"><img class="imgh" src="img/sadh.png">Фото<img class="imgh" src="img/sadh.png"></h3>
  <br>

  <div class="slider-container">
    <div class="slider">
      <?php foreach ($fotoModel as $foto) : ?>
        <div class="slide">
          <img data-enlargeable style="cursor: zoom-in" class="imgfoto" src="<?= $foto->getImage(); ?>" alt="...">
        </div>
      <?php endforeach; ?>
    </div>
    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
    <button class="next" onclick="changeSlide(1)">&#10095;</button>
  </div>
  <script>
    let currentSlide = 0;
    function showSlide(index) {
      const slides = document.querySelectorAll('.slide');
      if (index >= slides.length) {
        currentSlide = 0;
      } else if (index < 0) {
        currentSlide = slides.length - 1;
      } else {
        currentSlide = index;
      }
      const slider = document.querySelector('.slider');
      slider.style.transform = 'translateX(' + (-currentSlide * 100) + '%)';
    }

    function changeSlide(direction) {
      showSlide(currentSlide + direction);
    }
    // Инициализация первого слайда
    showSlide(currentSlide);
  </script>

  <?php if (!Yii::$app->user->isGuest) : ?>
    <?php if ($userModel->isAdmin == 1) : ?>
      <a class="addfoto last3" href="<?= Url::toRoute(['slider-image']) ?>">Добавить фото</a>
    <?php endif; ?>
  <?php endif; ?>
</div>


<br><br><br>

<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=98078758&amp;from=informer"
  target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/98078758/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="98078758" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->