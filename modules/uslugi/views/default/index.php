<?php

use app\assets\UslugiAsset;
use yii\helpers\Url;

UslugiAsset::register($this);
?>
<br>
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------->
<div style="text-align: center;">
  <h1 class="zagol">ЗавСадУслуги</h1>
  <h6>Ищите среди соседей</h6>
  <br>
</div>

<section>
  <div class="container">
    <div class="row">
      <?php foreach (array_reverse($uslugiModel) as $usluga) : ?>
        <div class="col">
          <div class="card">
            <p><strong><?= $usluga->usluga ?></strong><br> </p>
            <p class="card-footer"><?= $usluga->name ?> <img src="../../web/img/phone.svg" alt=""><?= $usluga->phone ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>




<br><br><br><br><br><br>