<?php
use yii\helpers\Url;
use app\assets\IndexAsset;

IndexAsset::register($this);
?>

<header>
  <div class="logo"><img width="50px" src="/img/logo.png" alt=""> СНТСН Завьяловские сады</div>
  <nav>
    <ul class="nav-links">
      <?php if (!Yii::$app->user->isGuest) : ?>
        <li><a class="a-nav" href="<?= Url::toRoute(['/']) ?>">Главная</span></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['site/profile']) ?>">Моя страница</span></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['/suggestions/suggestions/index']) ?>">Предложения</a></li>
        <li><a class="a-nav" href="<?= Url::toRoute(['/uslugi/uslugi/index']) ?>">ЗавСадУслуги</a></li>
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

<br><br><br><br><br><br><br>

<h3 class="addfoto last3">Архив новостей СНТ Завьяловские сады</h3>
<br>

<section class="container">
    <?php foreach (array_reverse($oldNewsModel) as $news) : ?>
        <blockquote>
            <h3><?= $news->title ?></h3>
            <?= $news->content ?>
            <br>
            <?php if ($news->photo) : ?>
              <div class="newsfoto">
            <img  class="newsfoto" data-enlargeable style="cursor: zoom-in"  src="<?= $news->getImage() ?>">
            </div>
            <?php endif; ?>
            <br>
            <?= Yii::$app->formatter->asDate($news->date, 'php:d-m-Y'); ?>
        </blockquote>
    <?php endforeach; ?>
</section>

<br><br><br><br>