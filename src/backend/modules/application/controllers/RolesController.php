<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\controllers;

use yii\web\Controller;
use yii\base\Exception;
use app\modules\application\components\QApplication;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Description of RolesController
 *
 * @author francisco
 */
class RolesController extends Controller {

    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $data["data"] = QApplication::getAll();

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionSave() {
        $nombre = Yii::$app->request->post("nombre");

        Utils::show($nombre);
    }

}
