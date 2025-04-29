<?php

use app\models\Uslugi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\UslugiAsset;

UslugiAsset::register($this);
/** @var yii\web\View $this */
/** @var app\models\UslugiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="uslugi-index">
    <br><br><br><br>
    <span><a href="<?= Url::toRoute(['/']) ?>">Главная</a> > Камеры</span>
    <br><br>

    <div class="nav-up">
        <h1 class="zagol">Камеры</h1>
    </div>
    <br>



    <style>
        .cams div {
            display: none;
            /* Скрываем все видео по умолчанию */
        }

        .message {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>


    <div>
        <button class="btn btn-info" onclick="showVideo(0)">Ворота</button>
        <button class="btn btn-info" onclick="showVideo(1)">Мусорные баки</button>
        <button class="btn btn-info" onclick="showVideo(2)">Детская площадка</button>
    </div>
    <br><br><br>
    <div class="message" id="message"><br><br>Выберите камеру для просмотра<br><br><br><br></div>

    <div class="cams">
        <div id="video0">
            <iframe width="340" height="190" src="https://rtsp.me/embed/QsKeTRFA/" frameborder="0" title="RTSP стриминговый плеер" allowfullscreen>
                Iframes не поддерживается. Трансляция <a href="https://rtsp.me/ru/" title="rtsp video steaming service">RTSP.ME</a> плеер </iframe>
        </div>
        <div id="video1">
            <?php
            $time = time() + 600;
            $token = str_replace("=", "", strtr(base64_encode(hash('sha256', 'a5ad3c9b9c8063dc4d8dccbd6ff3e82fbf1e79aae6fc163a8df7493c55be4870' . $time, true)), "+/", "-_"));
            echo "<iframe width='340' height='190' src='https://rtsp.me/private/432264/{$token}/{$time}/' frameborder='0'  title='RTSP стриминговый плеер' allowfullscreen>
Iframes не поддерживается. Трансляция  <a href='https://rtsp.me/ru/' title = 'rtsp streaming'>RTSP.me</a> сервис</iframe>";
            ?>
        </div>
        <div id="video2"><iframe width="340" height="190" src="https://rtsp.me/embed/BQk2HkbF/" frameborder="0" title="RTSP стриминговый плеер" allowfullscreen></iframe></div>
    </div>

    <script>
        function showVideo(index) {
            // Скрываем все видео
            const videos = document.querySelectorAll('.cams div');
            videos.forEach(video => {
                video.style.display = 'none';
            });

            // Скрываем текстовое сообщение
            const message = document.getElementById('message');
            message.style.display = 'none';

            // Показываем только выбранное видео
            const selectedVideo = document.getElementById('video' + index);
            if (selectedVideo) {
                selectedVideo.style.display = 'block';
            }
        }
    </script>


    <br><br><br>

</div>

<!-- <a href="https://rtsp.me" title='RTSP.ME - Free website RTSP video steaming service' target="_blank">rtsp.me</a> -->
<!-- https://rtsp.me/ru/edit/RsbG9BRd сайт где делать ссылки  -->
<!-- rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=19&subtype=0 ссылка на камеры
 
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=4&subtype=0 ворота
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=11&subtype=0 мусорки
rtsp://rtspuser:rtspuser11223344@178.178.99.24:554/cam/realmonitor?channel=9&subtype=0 детская площадка
-->