<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\controllers;

use app\components\MainController;
use yii\base\Exception;
use app\modules\application\components\UApplication;
use app\models\ApplicationPermit;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Description of RolesController
 *
 * @author francisco
 */
class PermissionsController extends MainController {

    public function actionList_role_own() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol = Yii::$app->request->get("id");

            $data['data'] = UApplication::getOwnActionByRole($id_rol);

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

            $data['data'] = UApplication::getAvailableActionByRole($id_rol);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionAdd() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_rol    = Yii::$app->request->post("id_role");
            $id_accion = Yii::$app->request->post("id_action");

            $model            = new ApplicationPermit();
            $model->id_action = $id_accion;
            $model->id_role   = $id_rol;

            if (!$model->save()) {
                throw new Exception("Error al agregar permiso al rol - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Acción #{$id_accion} agregada al Rol #{$id_rol}", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionRemove() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_permit    = Yii::$app->request->post("id_permit");
            $model        = ApplicationPermit::findOne($id_permit);
            $model->state = 0;

            if (!$model->save()) {
                throw new Exception("Error al remover permiso al rol - " . print_r($model->getErrors(), true), 900);
            }

            $id_rol    = Yii::$app->request->post("id_role");
            $id_accion = Yii::$app->request->post("id_action");

            $transaction->commit();
            JSON::response(FALSE, 200, "Acción #{$id_accion} removida del Rol #{$id_rol}", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
