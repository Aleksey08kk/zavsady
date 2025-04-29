<?php

namespace app\modules\uslugi\controllers;

use app\models\Uslugi;
use yii\web\Controller;

/**
 * Default controller for the `uslugi` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $uslugiModel = Uslugi::find()->all();
        return $this->render('index', [
            'uslugiModel' => $uslugiModel
        ]);
    }
}



