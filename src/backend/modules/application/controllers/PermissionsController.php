<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\controllers;

use app\components\MainController;
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
class PermissionsController extends MainController {

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

    public function actionList_role_own() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol = Yii::$app->request->get("id");

            $data = [];

            $data['data'][] = ["id_role" => $id_rol, "id" => 1, "name_action" => "Registrar", "type" => "own"];


            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionList_role_available() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol = Yii::$app->request->get("id");

            $data = [];

            $data['data'][] = ["id_role" => $id_rol, "id" => 2, "name_action" => "Editar", "type" => "available"];


            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionAdd() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol    = Yii::$app->request->post("id_role");
            $id_accion = Yii::$app->request->post("id");

            $data = ['rol' => $id_rol, 'accion' => $id_accion];

            JSON::response(FALSE, 200, "Acción #{$id_accion} agregada al Rol #{$id_rol}", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionRemove() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol    = Yii::$app->request->post("id_role");
            $id_accion = Yii::$app->request->post("id");

            $data = ['rol' => $id_rol, 'accion' => $id_accion];

            JSON::response(FALSE, 200, "Acción #{$id_accion} removida del Rol #{$id_rol}", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
