<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\MainAsset;
use yii\bootstrap4\Html;
use yii\helpers\Url;

MainAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/sadicon.svg" type="image/svg+xml">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>


<!--
<header>
  <a href="<?= Url::toRoute(['/']) ?>">
    <h1 class="logo a">
      <p>завьяловские</p>
      <p>сады</p>
    </h1>
  </a>
  <nav>
    <?php if (Yii::$app->user->isGuest) : ?>
      <button style="font-size: 14px;">
        <a class="a nav" href="<?= Url::toRoute(['auth/signup']) ?>">регистрация</a>
      </button>
    <?php endif; ?>
    <?php if (Yii::$app->user->isGuest) : ?>
      <button style="font-size: 14px;">
        <a class="a nav" href="<?= Url::toRoute(['auth/login']) ?>">войти</a>
      </button>
    <?php endif; ?>
    <?php if (!Yii::$app->user->isGuest) : ?>
      <button style="font-size: 14px;">
        <a class="a nav" href="<?= Url::toRoute(['site/profile']) ?>">Личный кабинет</a>
      </button>
    <?php endif; ?>
    <button style="font-size: 14px;">
      <a class="a nav" href="#contacts">Контакты</a>
    </button style="font-size: 14px;">
    <?php if (!Yii::$app->user->isGuest) : ?>
      <button style="font-size: 14px;">
        <a class="a nav" href="<?= Url::toRoute(['/auth/logout']) ?>">Выйти</a>
      </button>
    <?php endif; ?>
  </nav>
</header>
<div>
  <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
      <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
      <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(140,255,140,0.7" />
      <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(140,255,140,0.5)" />
      <use xlink:href="#gentle-wave" x="48" y="5" fill="lightgreen" />
      <use xlink:href="#gentle-wave" x="48" y="7" fill="green" />
    </g>
  </svg>
</div>
    -->


<div class="main">
  <?= $content ?>
</div>




<footer id="contacts" class="footer">
  <div class="foot">

    <div class="firstblfo">
      <a href="<?= Url::toRoute(['/']) ?>">
        <h1 class="name-footer a">Завьяловские сады</p></h1>
      </a>
      
      <p class="footext">САДОВОДЧЕСКОЕ НЕКОММЕРЧЕСКОЕ ТОВАРИЩЕСТВО СОБСТВЕННИКОВ НЕДВИЖИМОСТИ</p>
      <p class="footext">427000, Удмуртская Республика, Завьяловский р-он, тер. СНТСН "Завьяловские сады", д. 25</p>
      <p class="footext">ИНН / КПП:<br /> 1831167843 / 184101001</p>
    </div>

    <div class="firstblfo">
      <p class="logoo a">Контакты</p>
        
      <div class="contactflex">
      <ul class="contacts">
        <li class="lifoo">
          <span class="icon-earphones"><img src="/img/phone.svg" alt="" class="img-fluid"></span>
          <a class="a" href="tel:79658423370">+7 (3412) 32 33 70</a>
        </li>
        <li class="lifoo">
          <span class="icon-earphones"><img src="/img/viber.svg" alt="" class="img-fluid"></span>
          <a class="a" href="viber://chat?number=%2B79177449425">Написать в viber</a>
        </li class="lifoo">
        <li>
        <li class="lifoo">
          <span class="icon-earphones"><img src="/img/telegram.svg" alt="" class="img-fluid"></span>
          <a class="a" href="https://t.me/+79177449425">Написать в telegram</a>
        </li>
      </ul>

      <ul class="contacts">
        <li class="lifoo">
          <span class="icon-earphones"><img src="/img/whatsapp.svg" alt="" class="img-fluid"></span>
          <a class="a" href="https://wa.me/79177449425?text=%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%D1%82%D0%B5.%20">Написать в whatsapp</a>
        </li>
        <span class="icon-envelope-open"><img src="/img/email.svg" alt="" class="img-fluid"></span>
        <a class="a">zavsad18@yandex.ru</a>
        </li>
        <li style="margin: 7px 0 0 0;">
          <span class="icon-envelope-open"><img src="/img/email.svg" alt="" class="img-fluid"></span>
          <a class="a">zavsad18@mail.ru</a>
        </li>
      </ul>
      </div>

    </div>
    
  </div>

  
  <a class="chonari" href="http://чонари.рф" target="_blank">Сайт разработан веб студией Чонари. Нажмите <strong>тут</strong> чтоб открыть сайт разработчика.</a>
   
</footer>


<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>