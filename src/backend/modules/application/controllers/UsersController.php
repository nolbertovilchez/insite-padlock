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
use app\models\ApplicationUserPermitAdditional;
use app\models\ApplicationUserPermitRestricted;
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
                ApplicationUserPermitAdditional::updateAll(['state' => 0], 'id_app_user = :id', [':id' => $user['id_app_user']]);
                ApplicationUserPermitRestricted::updateAll(['state' => 0], 'id_app_user = :id', [':id' => $user['id_app_user']]);
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

    public function actionList_permit_available() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app_user = Yii::$app->request->get("id");

            $data["data"] = UApplication::getActionsPermitAvailable($id_app_user);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionList_permit_own() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app_user = Yii::$app->request->get("id");

            $data["data"] = UApplication::getActionsPermitOwn($id_app_user);

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

            $id_app_user = Yii::$app->request->post("id_app_user");
            $id_accion   = Yii::$app->request->post("id_action");

            $model              = new ApplicationUserPermitAdditional();
            $model->id_action   = $id_accion;
            $model->id_app_user = $id_app_user;

            if (!$model->save()) {
                throw new Exception("Error al agregar accion adicional al usuario - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Acción #{$id_accion} agregada al Permiso Usuario #{$id_app_user}", []);
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

            $id_user_permit_add = Yii::$app->request->post("id_user_permit_add");
            $model              = ApplicationUserPermitAdditional::findOne($id_user_permit_add);
            $model->state       = 0;

            if (!$model->save()) {
                throw new Exception("Error al remover accion al usuario - " . print_r($model->getErrors(), true), 900);
            }

            $id_app_user = Yii::$app->request->post("id_app_user");
            $id_accion   = Yii::$app->request->post("id_action");

            $transaction->commit();
            JSON::response(FALSE, 200, "Acción #{$id_accion} removida del Permiso Usuario #{$id_app_user}", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionList_permit_allow() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app_user = Yii::$app->request->get("id");

            $data["data"] = UApplication::getActionsPermitAllow($id_app_user);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionList_permit_restricted() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app_user = Yii::$app->request->get("id");

            $data["data"] = UApplication::getActionsPermitRestricted($id_app_user);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionRestrict() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app_user = Yii::$app->request->post("id_app_user");
            $id_permit   = Yii::$app->request->post("id_permit");

            $model              = new ApplicationUserPermitRestricted();
            $model->id_permit   = $id_permit;
            $model->id_app_user = $id_app_user;

            if (!$model->save()) {
                throw new Exception("Error al restringir accion al usuario - " . print_r($model->getErrors(), true), 900);
            }

            $id_accion = Yii::$app->request->post("id_action");

            $transaction->commit();

            JSON::response(FALSE, 200, "Acción #{$id_accion} restringida al Permiso Usuario #{$id_app_user}", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionAllow() {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_user_permit_del = Yii::$app->request->post("id_user_permit_del");
            $model              = ApplicationUserPermitRestricted::findOne($id_user_permit_del);
            $model->state       = 0;

            if (!$model->save()) {
                throw new Exception("Error al permitir accion al usuario - " . print_r($model->getErrors(), true), 900);
            }

            $id_app_user = Yii::$app->request->post("id_app_user");
            $id_accion   = Yii::$app->request->post("id_action");

            $transaction->commit();
            JSON::response(FALSE, 200, "Acción #{$id_accion} permitida a Permiso Usuario #{$id_app_user}", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
