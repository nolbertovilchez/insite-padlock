<?php

namespace app\modules\application\controllers;

use app\components\MainController;
use yii\base\Exception;
use app\modules\application\components\QApplication;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Default controller for the `applications` module
 */
class ManageController extends MainController {

    public $section_title = "Aplicaciones";

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $this->current_title = "Listado";
        return $this->render('index');
    }

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
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $nombre = Yii::$app->request->post("nombre");

            JSON::response(FALSE, 200, "Aplicación registrada con éxito", []);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionUpdate() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $id   = Yii::$app->request->post("id");
            $type = Yii::$app->request->post("type");
            if ($type == "general") {
                $nombre = Yii::$app->request->post("nombre");
            } elseif ($type == "setting") {
                
            }

            JSON::response(FALSE, 200, "Aplicación actualizada con éxito", []);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionEdit() {
        $id = Yii::$app->request->get("id");

        $data['NAME_APP']    = "NOMBRE_APP";
        $data['ID_APP']      = $id;
        $this->current_title = $data['NAME_APP'];
        return $this->render('update', ["data" => $data]);
    }

}
