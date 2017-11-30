<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\controllers;

use Yii;
use app\modules\application\components\UApplication;
use app\components\JSON;
use yii\base\Exception;

/**
 * Description of ApiController
 *
 * @author francisco
 */
class ApiController extends \app\components\MainController {

    /**
     * Función API del modulo aplicacion
     */
    public function actionIndex() {
        try {
            $id_app = Yii::$app->request->get("id");

            $data["data"] = UApplication::getUsersByApp($id_app);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
