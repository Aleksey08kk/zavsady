<?php

use app\assets\ProfileAsset;
use app\models\AllLands;
use app\models\BusinessOffer;
use PHPExcel_IOFactory as GlobalPHPExcel_IOFactory;
use yii\helpers\Url;

ProfileAsset::register($this);
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


<head>
  <link rel="icon" href="img/sadicon.svg" type="image/svg+xml">
</head>


<br>

<div class="container">
  <div class="main-body">

    <br>

    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img class="addfoto" src="<?= $userModel->getImage(); ?>">
              <a class="update" href="<?= Url::toRoute(['set-image', 'userId' => $userModel->id]) ?>"></a>
            </div>
          </div>
        </div>

        <div class="card mt-3">
          <span class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
            <h6 class="mb-0 flexctntre">
              <?php if ($userModel->isAdmin == 1) : ?>
                <a class="btn btn-primary" href="<?= Url::toRoute(['/admin/default/index']) ?>">Админ</a>
              <?php endif; ?>
              <a class="btn btn-info " href="<?= Url::toRoute(['site/index']) ?>">На главную</a>
              <?php if ($userModel->isAdmin !== 1) : ?>
                <a class="btn btn-info " href="<?= Url::toRoute(['site/update']) ?>">Настройки</a>
              <?php endif; ?>
          </span>
        </div>

        <div class="card mt-3">
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Адрес</span>
              <h6 class="mb-0"><?= Yii::$app->user->identity->street ?></h6>
            </li>
            <?php if (count($allLandsModelSomeAddress) > 1) : ?>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <span class="text-secondary">Смотреть другой адрес</span>
                <?php foreach ($allLandsModelSomeAddress as $addres) : ?>
                  <a href="<?= Url::toRoute(['other-profile', 'idAllLand' => $addres->id,]) ?>">
                    <h6 class="mb-0"><?= $addres->street_and_num ?></h6>
                  </a>
                <?php endforeach; ?>
              </li>
            <?php endif; ?>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Имя</span>
              <h6 class="mb-0"><?= $userModel->name . ' ' . $userModel->last_name ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Эл. Почта</span>
              <h6 class="mb-0"><?= $userModel->email ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Телефон</span>
              <h6 class="mb-0"><?= $userModel->telephone ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Количество соток</span>
              <h6 class="mb-0"><?= $allLandsModel->how_much_sotok / 100 ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary">Сумма взноса 2024-2025г.</span>
              <h6 class="mb-0"><?= $allLandsModel->accrual ?> р.</h6>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

              <?php if ($gasModel->sum > 40000) : ?>
                <span class="text-secondary">Из суммы взноса вычтена сумма возврата за газ в размере 7033.05руб.</span>
              <?php endif; ?>
              <span class="text-secondary">Долги по взносам</span>


              <?php if ($allLandsModel->debt_str > 0) : ?>
                <?php if ($gasModel->sum > 40000) : ?>
                  <h6 class="mb-0"><?= $allLandsModel->debt_str - 7033.05 ?> р.</h6>
                <?php endif; ?>

                <?php if ($gasModel->sum < 40001) : ?>
                  <h6 class="mb-0"><?= $allLandsModel->debt_str ?> р.</h6>
                <?php endif; ?>
              <?php endif; ?>


              <?php if ($allLandsModel->debt_str < 1) : ?>
                <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
              <?php endif; ?>
              <?php if ($allLandsModel->debt_str < 0) : ?>
                <h5 class="mb-0 nodebt">Переплата <?= $allLandsModel->debt_str ?> р.</h5>
              <?php endif; ?>
            </li>

            <?php if ($gasModel) : ?>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <span class="text-secondary">Платёж за обслуживание и страхование газопровода. Оплачивается отдельной суммой с указанием адреса в размере 1233.61 руб.</span>

                <span class="text-secondary">К оплате: </span>
                <?php if ($gasModel->gas_insurance < 1233.61) : ?>
                  <h6 class="mb-0"><?= number_format(1233.61 - $gasModel->gas_insurance, 2, '.', '')  ?> р.</h6>
                <?php endif; ?>
                <?php if ($gasModel->gas_insurance == 1233.61) : ?>
                  <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
                <?php endif; ?>

              </li>
            <?php endif; ?>

            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <br>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="mb-0">Передать паспортные данные правлению:</span>
              <ul class="contacts">
                <li class="lifoo">
                  <span class="icon-earphones"><img src="/img/phoneblack.svg" alt="" class="img-fluid"></span>
                  <a class="" href="tel:73421323370">+7 (3412) 32 33 70</a>
                </li>
                <li class="lifoo">
                  <span class="icon-earphones"><img src="/img/viber.svg" alt="" class="img-fluid"></span>
                  <a class="" href="viber://chat?number=%2B79177449425">Написать в viber</a>
                </li class="lifoo">
                <li>
                <li class="lifoo">
                  <span class="icon-earphones"><img src="/img/telegram.svg" alt="" class="img-fluid"></span>
                  <a class="" href="https://t.me/+79177449425">Написать в telegram</a>
                </li>
              </ul>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <span class="text-secondary"> </span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
              <a class="" href="viber://chat?number=%2B79512175434">Сообщить об ошибке в viber</a>
            </li>
          </ul>
        </div>
      </div>


      <div class="col-md-8">

        <div class="tabset">
          <!-- Tab 1 -->
          <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
          <label for="tab1">Платежка</label>
          <!-- Tab 2 -->
          <input type="radio" name="tabset" id="tab2" aria-controls="two">
          <label for="tab2">История платежей</label>
          <!-- Tab 3 -->
          <input type="radio" name="tabset" id="tab3" aria-controls="thr">
          <label for="tab3">Протоколы</label>
          <!-- Tab 4 -->
          <input type="radio" name="tabset" id="tab4" aria-controls="four">
          <label for="tab4">Учредительные документы</label>
          <!-- Tab 5 -->
          <input type="radio" name="tabset" id="tab5" aria-controls="five">
          <label for="tab5">Газ</label>


          <div class="tab-panels">

            <section id="marzen" class="tab-panel">
              <h4>Платежки</h4>
              <br>
              <!-- первая карточка с QR -->
              <div class="forqr">
                <div class="cardplatqr">
                  <div class="textqr">
                    <h4>Платежные реквизиты</h4>
                    <span class="text-secondary">Сумма взноса 2024-2025г.</span>
                    <h6 class="mb-0"><?= $allLandsModel->accrual ?> р.</h6>
                    <?php if ($gasModel->sum > 40000) : ?>
                      <span class="text-secondary">Возврат за газ - 7033.05руб.</span>
                    <?php endif; ?>
                    <br>

                    <?php if ($allLandsModel->debt_str > 0) : ?>
                      <span class="text-secondary">К оплате</span>
                      <?php if ($gasModel->sum > 40000 && $allLandsModel->debt_str - 7033.05 != 0) : ?>
                        <h6 class="mb-0"><mark><?= $allLandsModel->debt_str - 7033.05 ?> р.</mark></h6>
                      <?php endif; ?>

                      <?php if ($gasModel->sum < 40001) : ?>
                        <h6 class="mb-0"><mark><?= $allLandsModel->debt_str ?> р.</mark></h6>
                      <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($allLandsModel->debt_str < 1 || $allLandsModel->debt_str == 7033.05) : ?>
                      <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
                    <?php endif; ?>
                    <!--<?php if ($allLandsModel->debt_str < 0) : ?>
                      <h5 class="mb-0 nodebt">Переплата <?= $allLandsModel->accrual ?> р.</h5>
                    <?php endif; ?>-->
                  </div>

                  <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/plateska24-25.png" alt="">
                  <?php
                  // Генерация первого QR для основного взноса
                  include('libreris/phpqrcode/qrlib.php');
                  $tempDir = "qrcodes/";
                  $tempDirget = "../qrcodes/";
                  $codeContents = 'ST00012|Name=СНТ Завьяловские сады|PersonalAcc=40703810668000001278|BankName=УДМУРТСКОЕ ОТДЕЛЕНИЕ N8618 ПАО СБЕРБАНК|BIC=049401601|CorrespAcc=30101810400000000601|KPP=184101001|PayeeINN=1831167843|lastName=' . $userModel->name . ' ' . $userModel->last_name . '|PayerAddress=' . $allLandsModel->street_and_num . '|Purpose=Оплата взносов 2024-2025г..';
                  $fileName = '005_file_' . md5($codeContents) . '.png';

                  $pngAbsoluteFilePath = $tempDir . $fileName;
                  $urlRelativeFilePath = $tempDirget . $fileName;

                  if (!file_exists($pngAbsoluteFilePath)) {
                    QRcode::png($codeContents, $pngAbsoluteFilePath);
                    //echo 'QR сгенерирован!';
                    //echo '<hr />';
                  } else {
                    //echo 'File already generated! We can use this cached file to speed up site on common codes!';
                    //echo '<hr />';
                  }
                  echo '<img  data-enlargeable style="cursor: zoom-in" class="imgcard" src="' . $urlRelativeFilePath . '" />';

                  // Генерация второго QR для дополнительного взноса
                  $codeContentsq = 'ST00012|Name=СНТ Завьяловские сады|PersonalAcc=40703810668000001278|BankName=УДМУРТСКОЕ ОТДЕЛЕНИЕ N8618 ПАО СБЕРБАНК|BIC=049401601|CorrespAcc=30101810400000000601|KPP=184101001|PayeeINN=1831167843|lastName=' . $userModel->name . ' ' . $userModel->last_name . '|payerAddress=' . $allLandsModel->street_and_num . '|Purpose=Оплата дополнительного взноса 2024-2025г..';
                  $fileNameq = '005_file_' . md5($codeContentsq) . '.png';

                  $pngAbsoluteFilePathq = $tempDir . $fileNameq;
                  $urlRelativeFilePathq = $tempDirget . $fileNameq;

                  if (!file_exists($pngAbsoluteFilePathq)) {
                    QRcode::png($codeContentsq, $pngAbsoluteFilePathq);
                    //echo 'QR сгенерирован!';
                    //echo '<hr />';
                  } else {
                    //echo 'File already generated! We can use this cached file to speed up site on common codes!';
                    //echo '<hr />';
                  }
                  ?>
                </div>
              </div>
              <br>
              <!-- 2 карточка с QR -->
              <div class="forqr">
                <div class="cardplatqr">
                  <div class="textqr">
                    <h4>Платежка дополнительного целевого взноса 2024 - 2025 г.</h4>
                    <span class="text-secondary">Сумма дополнительного взноса 2024-2025г.</span>
                    <h6 class="mb-0"><?= $allLandsModel->how_much_sotok / 100 * 352.50 ?> р.</h6>
                    <br>

                    <?php if ($allLandsModel->dop_accrual > 0) : ?>
                      <span class="text-secondary">К оплате</span>
                      <h6 class="mb-0"><mark><?= $allLandsModel->dop_accrual ?> р.</mark></h6>
                    <?php endif; ?>

                    <?php if ($allLandsModel->dop_accrual < 1) : ?>
                      <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
                    <?php endif; ?>
                    <?php if ($allLandsModel->dop_accrual < 0) : ?>
                      <h5 class="mb-0 nodebt">Переплата <?= $allLandsModel->dop_accrual ?> р.</h5>
                    <?php endif; ?>
                  </div>

                  <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/dopplateska24-25.jpg" alt="">
                  <!-- Вывод воторго QR для дополнительного взноса -->
                  <?php echo '<img data-enlargeable style="cursor: zoom-in" class="imgcard" src="' . $urlRelativeFilePathq . '" />'; ?>
                </div>
              </div><br>
              <!-- 3 карточка с QR -->
              <?php if ($gasModel) : ?>
                <div class="forqr">
                  <div class="cardplatqr">
                    <div class="textqr">
                      <h4>Платёжка за обслуживание и страхование газопровода</h4>
                      <span class="text-secondary">Оплачивается отдельной суммой с указанием адреса в размере 1233.61 руб.</span>
                      <br>

                      <?php if ($gasModel->gas_insurance < 1233.61) : ?>
                        <span class="text-secondary">К оплате</span>
                        <h6 class="mb-0"><mark><?= number_format(1233.61 - $gasModel->gas_insurance, 2, '.', '') ?> р.</mark></h6>
                      <?php endif; ?>
                      <?php if ($gasModel->gas_insurance > 1233.61) : ?>
                        <span class="text-secondary">Переплата</span>
                        <h6 class="mb-0"><mark><?= number_format($gasModel->gas_insurance - 1233.61, 2, '.', '')  ?> р.</mark></h6>
                      <?php endif; ?>

                      <?php if ($gasModel->gas_insurance >= 1233.61) : ?>
                        <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
                      <?php endif; ?>
                    </div>

                    <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/service-gas.png" alt="">
                    <!-- Вывод третьего QR для страхование газопровода -->
                    <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/service-gas-qr.gif">
                  </div>
                </div>
              <?php endif; ?><br>
              <!-- 4 карточка с QR -->
              <?php if ($allLandsModel->dop_two_accrual >= 0) : ?>
                <div class="forqr">
                  <div class="cardplatqr">
                    <div class="textqr">
                      <h4>Платёжка за отсыпку дороги. <br>Доп взнос 7000р.</h4>
                      <br>

                      <?php if ($allLandsModel->dop_two_accrual < 7000) : ?>
                        <span class="text-secondary">К оплате</span>
                        <h6 class="mb-0"><mark><?= number_format(7000 - $allLandsModel->dop_two_accrual, 2, '.', '') ?> р.</mark></h6>
                      <?php endif; ?>
                      <?php if ($allLandsModel->dop_two_accrual > 7000) : ?>
                        <span class="text-secondary">Переплата</span>
                        <h6 class="mb-0"><mark><?= number_format($allLandsModel->dop_two_accrual - 7000, 2, '.', '')  ?> р.</mark></h6>
                      <?php endif; ?>

                      <?php if ($allLandsModel->dop_two_accrual >= 7000) : ?>
                        <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
                      <?php endif; ?>
                    </div>

                    <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/dop-sec.png" alt="">
                    <!-- Вывод третьего QR для страхование газопровода -->
                    <img data-enlargeable style="cursor: zoom-in" class="imgcard" src="../img/dop-sec.gif">
                  </div>
                </div>
              <?php endif; ?><br>

              <!-- 5 карточка напоминание -->
              <?php if ($gasModel->sum != 40000 || $gasModel->sum != 97726.70) : ?>
                <div class="forqr">
                  <div class="cardplatqr">
                    <div class="textqr">
                      <h4>Где еще может быть долг?</h4>
                      <span class="text-secondary">Скорее всего за газ. Вся информация по газу находится во вкладке "Газ"</span>
                      <br>
                    </div>
                  </div>
                </div>
              <?php endif; ?><br>

              <p>нажмите на изображения чтоб увеличить</p>
              <p>Пожалуйста проверяйте данные с QR кода</p>
              <!-- конец вывода QR -->
              <br><br><br><br><br>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">
                      <input class="hide" id="hd-3" type="checkbox">
                      <label for="hd-3">Платежки за 2023 - 2024 г.</label>
                      <div>
                        <h4 style="margin-left: 0ch;">Платежки за 2023 - 2024 г.</h4>
                        <img class="imgprofile" src="../img/sbp.png" alt="">
                      </div>
                    </span>
                  </li>
                </ul>
              </div>
            </section>

            <section id="two" class="tab-panel">
              <h4>История начислений взносов:</h4>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2019 - 31.08.2020</span>
                    <span class="">5000 руб. за участок</span>
                  </li>
                </ul>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2020 - 31.08.2021</span>
                    <span class="">986 руб/сот. * кол. соток = <?= $allLandsModel->how_much_sotok / 100 * 986 ?> руб.</span>
                  </li>
                </ul>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2021 - 31.08.2022</span>
                    <span class="">986 руб/сот. * кол. соток = <?= $allLandsModel->how_much_sotok / 100 * 986 ?> руб.</span>
                  </li>
                </ul>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2022 - 31.08.2023</span>
                    <span class="">986 руб/сот. * кол. соток = <?= $allLandsModel->how_much_sotok / 100 * 986 ?> руб.</span>
                    <span class="">+ 7000 руб. на отсыпку дорог.</span>
                  </li>
                </ul>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2023 - 31.08.2024</span>
                    <span class="">1235 руб/сот. * кол. соток = <?= $allLandsModel->how_much_sotok / 100 * 1235 ?> руб.</span>
                  </li>
                </ul>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="">01.09.2024 - 31.08.2025</span>
                    <span class="">1180.60 руб/сот. * кол. соток = <?= $allLandsModel->how_much_sotok / 100 * 1180.60 ?> руб.</span>
                    <span class="">+ Дополнительный взнос на дорогу 352.50р. за сотку. = <?= $allLandsModel->how_much_sotok / 100 * 352.50 ?> руб.</span>
                    <?php if ($gasModel) : ?>
                      <span class="">+ 1233.61 р. за обслуживание и страхование газопровода</span>
                    <?php endif; ?>
                  </li>
                </ul>
              </div>

              <br>
              <h4>История взносов из выписки Сбербанка</h4>
              <h6><mark>до <?= $lastHistoryPay->when_date ?></mark></h6>

              <?php foreach (array_reverse($historyPayModel, true) as $history) : ?>
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span class=""><?= $history->when_date ?>г.</span>
                      <span class=""><?= $history->address ?></span>
                      <?php if ($history->messege !== '0') : ?>
                        <span class=""><?= $history->messege ?></span>
                      <?php endif; ?>
                      <span class=""><?= $history->sum ?>р.</span>
                    </li>
                  </ul>
                </div>
              <?php endforeach; ?>

              <br><br>
              <h4>Выписка за период с 01 сентября 2023 г. по 27 апреля 2025 г.</h4>
              <a target="_blank" href="/pdfFromSber/СберБизнес. Выписка за 2023.09.01-2025.04.27 счёт 40703810668000001278.pdf">Открыть в новом окне</a>
              <br><br>
              <embed class="pdf" src="/pdfFromSber/СберБизнес. Выписка за 2023.09.01-2025.04.27 счёт 40703810668000001278.pdf" width="100%" height="400px" />
              <br><br>
            </section>

            <section id="thr" class="tab-panel">
              <h4>Протоколы собраний</h4>
              <?php foreach ($protocolModel as $protocol) : ?>
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span class="text-secondary"><?= $protocol->description ?></span>
                      <a class="mb-0" href="/uploads/<?= $protocol->photo ?>" target="_blank"><?= $protocol->title ?></a>
                    </li>
                  </ul>
                </div>
              <?php endforeach; ?>
              <br>
              <h4>Финансово - экономическое обоснование взносов</h4>

              <div class="demoo">
                <input class="hide" id="hd-4" type="checkbox">
                <label for="hd-4">За 2019-2020</label>
                <div>
                  <img class="imgprofile" src="/img/2019-2020.jpg" alt="">
                </div>
                <br />
                <br />
                <input class="hide" id="hd-5" type="checkbox">
                <label for="hd-5">За 2020-2021</label>
                <div>
                  <img class="imgprofile" src="/img/2020-2021.jpg" alt="">
                </div>
                <br /><br>
                <input class="hide" id="hd-6" type="checkbox">
                <label for="hd-6">За 2020-2021</label>
                <div>
                  <h4>Платежки за предыдущие года</h4>
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                  <img class="imgprofile" src="/img/2021-2022.jpg" alt="">
                </div>
              </div>

            </section>

            <section id="four" class="tab-panel">
              <?php foreach ($docsModel as $doc) : ?>
                <div class="card mt-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span class="text-secondary"><?= $doc->description ?></span>
                      <a class="mb-0" href="/uploads/<?= $doc->file ?>" target="_blank"><?= $doc->title ?></a>
                    </li>
                  </ul>
                </div>
              <?php endforeach; ?>
            </section>


            <section id="five" class="tab-panel">
              <h4>Информация про газ</h4><br>
              <?php if ($gasModel->sum > 40001) : ?>
                <br>
                <h4>В 2024 году будет компенсация из суммы взносов в размере 7033.05руб.</h4><br>
              <?php endif; ?>
              <?php if ($gasModel->sum === null) : ?>
                <span class="icon-earphones">Как подключить газ? Звоните: <img src="/img/phoneblack.svg" alt="" class="img-fluid"></span>
                <a class="" href="tel:73421323370">Дмитрий +7 (3421) 32 33 70</a>
              <?php endif; ?>

              <?php if ($gasModel->sum !== null) : ?>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <span class="text-secondary"><?= $gasModel->street_and_num ?></span>
                    <span>Оплачено: <?= $gasModel->sum ?> руб.</span>
                  </li>


                  <?php if ($gasModel->additionally != null) : ?>
                    <br><span><?= $gasModel->additionally ?></span><br>
                  <?php endif; ?>

                  <?php if ($gasModel->sum > 40001 && $gasModel->sum < 97726.70) : ?>
                    <br>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span>Необходимо доплатить до суммы 97726.70руб.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span><mark>Сумма к доплате: <?= 97726.7 - $gasModel->sum ?></mark></span>
                    </li>
                  <?php endif; ?>
                  <?php if ($gasModel->sum < 40001 && $gasModel->sum < 40000) : ?>
                    <br>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span>Необходимо доплатить до суммы 40000руб.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <span><mark>Сумма к доплате: <?= 40000 - $gasModel->sum ?></mark></span>
                    </li>
                  <?php endif; ?>

                </ul>
              <?php endif; ?>

              <?php if ($gasModel->sum != 40000 && $gasModel->sum != 97726.70) : ?>
                <h5>Реквизиты оплаты за газ</h5>
                <img class="imgprofile" src="../img/gas.png" alt="">
              <?php endif; ?>
              <?php if ($gasModel->sum == 40000 || $gasModel->sum == 97726.70) : ?>
                <h5 class="mb-0 nodebt"><img class="imgnodebt" src="/img/check.svg" alt=""> Долгов нет</h5>
              <?php endif; ?>
            </section>

          </div>

        </div>
      </div>



    </div>
  </div>
</div>

<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=98078758&amp;from=informer"
  target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/98078758/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"
    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="98078758" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->