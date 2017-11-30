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
use app\components\JSON;
use app\models\ApplicationAction;
use app\components\Utils;
use Yii;

/**
 * Description of RolesController
 *
 * @author francisco
 */
class ActionsController extends MainController {

    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $id_app = Yii::$app->request->get("id");

            $data["data"] = UApplication::getActionsByApp($id_app);

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
            $action = Yii::$app->request->post("actions");

            if (isset($action['id_action']) && $action['id_action'] != "") {
                $model = ApplicationAction::findOne($action['id_action']);
            } else {
                $model = new ApplicationAction();
            }

            $model->attributes = $action;
            $model->id_app     = Yii::$app->request->post("id");

            if (!$model->save()) {
                throw new Exception("Error al registrar la accion - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Acción registrada con éxito", []);
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

            $id_action    = Yii::$app->request->post("id_action");
            $model        = ApplicationAction::findOne($id_action);
            $model->state = 0;

            if (!$model->update()) {
                throw new Exception("Error al eliminar la accion - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Acción eliminada con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
