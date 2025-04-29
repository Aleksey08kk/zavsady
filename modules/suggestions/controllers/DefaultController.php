<?php

namespace app\modules\suggestions\controllers;

use yii\web\Controller;

/**
 * Default controller for the `suggestions` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
