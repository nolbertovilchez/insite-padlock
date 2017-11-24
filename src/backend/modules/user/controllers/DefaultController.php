<?php

namespace app\modules\user\controllers;

/**
 * Default controller for the `user` module
 */
class DefaultController extends yii\web\Controller
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
