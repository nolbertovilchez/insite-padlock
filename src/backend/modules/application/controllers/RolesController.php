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
use app\models\ApplicationRole;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Description of RolesController
 *
 * @author francisco
 */
class RolesController extends MainController {

    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app = Yii::$app->request->get("id");

            $data["data"] = UApplication::getRolesByApp($id_app);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionSave() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $role = Yii::$app->request->post("roles");

            if (isset($role['id_role']) && $role['id_role'] != "") {
                $model = ApplicationRole::findOne($role['id_role']);
            } else {
                $model = new ApplicationRole();
            }

            $model->attributes = $role;
            $model->id_app     = Yii::$app->request->post("id");

            if (!$model->save()) {
                throw new Exception("Error al registrar el rol - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Rol registrado con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionDelete() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_role      = Yii::$app->request->post("id_role");
            $model        = ApplicationRole::findOne($id_role);
            $model->state = 0;

            if (!$model->update()) {
                throw new Exception("Error al eliminar el rol - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Rol eliminado con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
