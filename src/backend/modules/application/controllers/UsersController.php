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
use app\models\ApplicationUser;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Description of RolesController
 *
 * @author francisco
 */
class UsersController extends MainController {

    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app = Yii::$app->request->get("id");

            $data["data"] = UApplication::getUsersByApp($id_app);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionList_users_no_app() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app = Yii::$app->request->get("id");
            $term   = Yii::$app->request->get("term");

            JSON::response(false, 200, "", [
                "response" => [
                    "items" => UApplication::getUsersNoApp($id_app, $term)
                ]
            ]);
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
            $user = Yii::$app->request->post("users");

            if (isset($user['id_app_user']) && $user['id_app_user'] != "") {
                $model = ApplicationUser::findOne($user['id_app_user']);
            } else {
                $model = new ApplicationUser();
            }

            $model->attributes = $user;
            $model->id_app     = Yii::$app->request->post("id");

            if (!$model->save()) {
                throw new Exception("Error al registrar el usuario - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Usuario registrado con éxito", []);
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

            $id_app_user  = Yii::$app->request->post("id_app_user");
            $model        = ApplicationUser::findOne($id_app_user);
            $model->state = 0;

            if (!$model->update()) {
                throw new Exception("Error al eliminar el usuario - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Usuario eliminado con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
