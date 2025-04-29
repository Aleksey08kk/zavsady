<?php

namespace app\assets;

use yii\web\AssetBundle;

class UslugiAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/uslugi.css',
    ];
    public $js = [
        'js/uslugi.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}

