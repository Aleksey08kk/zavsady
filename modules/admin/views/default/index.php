<?php

use app\assets\IndexAsset;
use PHPExcel_IOFactory as GlobalPHPExcel_IOFactory;
use yii\helpers\Url;

IndexAsset::register($this);
?>

<br>
<!--
require_once 'text/PHPExcel.php';
$excel = GlobalPHPExcel_IOFactory::load('text/allLands.xlsx');

$line = $excel->getActiveSheet()->getCell('A9');
//echo preg_replace("/тут вставить после какого знака скрыть остальной текст.+/", "", $line);
$lineAddress = preg_replace("/18:.+/", "", $line);
$addressLand = str_replace("№", "", $lineAddress);

var_dump(trim($addressLand));
-->

<h1>Админ </h1>

