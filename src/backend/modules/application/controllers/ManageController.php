<?php

namespace app\modules\application\controllers;

use app\components\MainController;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\models\Application;
use app\models\ApplicationConfiguration;
use app\modules\application\components\UApplication;
use app\components\JSON;
use app\components\Utils;
use app\components\Folder;
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

            $data["data"] = UApplication::getAll();

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

            $nombre           = Yii::$app->request->post("nombre");
            $model            = new Application();
            $model->name      = $nombre;
            $model->key       = Utils::generateToken($nombre);
            $model->secretkey = Utils::generateToken($model->key);

            if (!$model->save()) {
                throw new Exception("Error al guardar la aplicación - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Aplicación registrada con éxito", ['id' => $model->id_app]);
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

            $id_app       = Yii::$app->request->post("id_app");
            $model        = Application::findOne($id_app);
            $model->state = 0;

            if (!$model->update()) {
                throw new Exception("Error al eliminar la aplicación - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Aplicación eliminada con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionUpdate() {

        $transaction = Yii::$app->db->beginTransaction();

        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $id   = Yii::$app->request->post("id");
            $type = Yii::$app->request->post("type");
            if ($type == "general") {
                $nombre      = Yii::$app->request->post("nombre");
                $url         = Yii::$app->request->post("url");
                $model       = Application::findOne($id);
                $model->name = $nombre;
                $model->url  = $url;
                $upload      = UploadedFile::getInstanceByName("image");

                if ($upload) {
                    $urlfiles = Yii::getAlias("@webroot") . "/files/applications/{$id}/";

                    Folder::create($urlfiles);
                    $nombre_imagen = Utils::generateToken($id) . "." . $upload->getExtension();
                    if (!$upload->saveAs($urlfiles . "/" . $nombre_imagen)) {
                        throw new Exception("Error al guardar el archivo - " . print_r($upload->error, true), 900);
                    }
                    $model->image = $nombre_imagen;
                }
            } elseif ($type == "setting") {
                $configuracion = Yii::$app->request->post("setting");
                $model         = ApplicationConfiguration::findOne(['id_app' => $id, "state" => 1]);
                if (!$model) {
                    $model         = new ApplicationConfiguration();
                    $model->id_app = $id;
                }
                $model->attributes             = $configuracion;
                $model->session_reuse_sessions = (isset($configuracion['session_reuse_sessions'])) ? 1 : 0;
                $model->system_no_new_sessions = (isset($configuracion['system_no_new_sessions'])) ? 1 : 0;
            }

            if (!$model->save()) {
                throw new Exception("Error al guardar la aplicación - " . print_r($model->getErrors(), true), 900);
            }

            $transaction->commit();

            JSON::response(FALSE, 200, "Aplicación actualizada con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionEdit() {
        $id = Yii::$app->request->get("id");

        $data = UApplication::getByPk($id);

        $this->current_title = $data['name'];
        return $this->render('update', ["data" => $data]);
    }

}
