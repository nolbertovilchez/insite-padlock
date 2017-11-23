<?php

namespace app\modules\application\controllers;

use yii\web\Controller;
use app\modules\application\components\QApplication;
use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Default controller for the `applications` module
 */
class ManageController extends Controller {

    public $section_title = "Applications";

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
//        $this->current_title = "Listado";
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
        $nombre = Yii::$app->request->post("nombre");

        Utils::show($nombre);
    }

    public function actionUpdate() {
        $id = Yii::$app->request->get("id");
        
        $data['NAME_APP'] = "NOMBRE_APP";
//        $this->current_title = "Listado";
        return $this->render('update', ["data" => $data]);
    }

}
