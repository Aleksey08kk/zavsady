<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/sadicon.svg" type="image/svg+xml">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

<br>

    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?= Url::toRoute(['/site/index']) ?>">
            <h1 class="logo a">
                <p>завьяловские</p>
                <p>сады</p>
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navlinks" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navlinks">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/user/index']) ?>">Зарегистрированы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/all-lands/index']) ?>">Список участков</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/history-pay/index']) ?>">История взносов</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/debts/index']) ?>">Долги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/news/index']) ?>">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/protocols/index']) ?>">Протоколы собраний</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/proofs/index']) ?>">Обоснование взносов</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/gas/index']) ?>">Газ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/docs/index']) ?>">Учередительные документы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/uslugi/index']) ?>">ЗавСадУслуги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::toRoute(['/admin/flea-market/index']) ?>">Барахолка</a>
                </li>
            </ul>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


    <?= $content ?>







    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>