<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\controllers;

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
 * Description of ApplicationController
 *
 * @author francisco
 */
class ApplicationController extends MainController {
    
    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_user = Yii::$app->request->get("id");

            $data["data"] = UApplication::getAppsByUser($id_user);

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
            $apps = Yii::$app->request->post("apps");

            if (isset($apps['id_app_user']) && $apps['id_app_user'] != "") {
                $model = ApplicationUser::findOne($apps['id_app_user']);
                ApplicationUserPermitAdditional::updateAll(['state' => 0], 'id_app_user = :id', [':id' => $apps['id_app_user']]);
                ApplicationUserPermitRestricted::updateAll(['state' => 0], 'id_app_user = :id', [':id' => $apps['id_app_user']]);
            } else {
                $model = new ApplicationUser();
            }

            $model->attributes = $apps;
            $model->id_user    = Yii::$app->request->post("id");

            if (!$model->save()) {
                throw new Exception("Error al registrar la aplicación - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Aplicación registrada con éxito", []);
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

    public function actionList_users() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_users     = Yii::$app->request->get("id");
            $data["data"] = UApplication::getNoAppsByUser($id_users);

            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
