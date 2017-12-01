<?php

namespace app\modules\user\controllers;

use app\modules\user\components\ManageUser;
use app\modules\user\components\QUser;
use app\modules\user\models\User;
use app\modules\user\models\UserRecoveryOption;
use app\components\MainController;
use app\components\JSON;
use app\components\Utils;
use app\components\Chacad;
use app\models\Identis;
use yii\base\Exception;
use Yii;

/**
 * Administrador de usuarios
 */
class ManageController extends MainController {

    public $section_title = "Usuarios";

    public function actionIndex() {
        $this->current_title = "Listado";
        return $this->render('index');
    }

    /**
     * Obtener la lista de usuarios a mostrar en el bootstraptable
     */
    public function actionList() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $data["data"] = QUser::getAll();
            JSON::response(FALSE, 200, "", $data);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    /**
     * Checkea si un usuario existe en padlock y chacad
     */
    public function actionCheck() {
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $cod_per      = Yii::$app->request->post("cod_per");
            $user         = User::find()->where(['cod_per' => $cod_per])->one();
            $json_message = "";

            if ($user) {
                $response['data']['exist']   = true;
                $response['data']['id_user'] = $user->id_user;
                $response['data']['state']   = $user->state;
                $json_message                = "Usuario ya esta registrado en padlock";
            } else {
                // dni terra 42117913
                $response['data']['exist']           = false;
                $response['data']['chacad']['exist'] = false;

                if ($chacad = Chacad::getDatosPersonales($cod_per)) {
                    $response['data']['chacad']['exist'] = true;
                    $response['data']['chacad']['data']  = $chacad;
                }
                $json_message = "Usuario no existe en padlock";
            }

            JSON::response(FALSE, 200, $json_message, $response);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    /**
     * Guardar nuevo usuario
     * @throws Exception
     */
    public function actionSave() {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }

            $identis  = Yii::$app->request->post("identis");
            $contacto = Yii::$app->request->post("contacto");

            // registrar usuario en padlock
            $model               = new User();
            $model->setScenario('create');
            $model->cod_per      = $identis['CodPer'];
            $model->id_type_user = 1;
            $model->username     = $identis['CodPer'];
            $model->password     = 'myPass';
            $model->state_user   = 1;
            $model->state        = 1;

            if (!$model->save()) {
                throw new Exception('[Error al crear usuario] ' . Utils::getErrorsText($model->getErrors()), 900);
            }

            $id_user        = $model->id_user;
            $model          = new UserRecoveryOption();
            $model->id_user = $id_user;
            $model->email   = $contacto['email'];
            $model->number  = $contacto['telefono'];
            $model->state   = 1;

            if (!$model->save()) {
                throw new Exception('[Error al crear los datos de recuperación del usuario] ' . Utils::getErrorsText($model->getErrors()), 900);
            }
            // si el usuario existe en chacad
            if (isset($identis['CodIden']) && $identis['CodIden'] != '') {
                $chacad             = Identis::findOne($identis['CodIden']);
                $chacad->attributes = $identis;
            } else {
                $chacad             = new Identis();
                $chacad->attributes = $identis;
                $chacad->CodIden    = Chacad::generateIdentisCodIden();
                $chacad->FReg       = date('Y-m-d h:i:s');
            }

            if (!$chacad->save()) {
                throw new Exception('[Error al crear/actualizar datos en chacad] ' . Utils::getErrorsText($chacad->getErrors()), 900);
            }

            $transaction->commit();
            $response['data']['id_user'] = $id_user;
            JSON::response(FALSE, 200, "Usuario registrado con éxito", $response);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    /**
     * Renderizar vista de Editar datos del usuario
     * 
     * @param type $id
     */
    public function actionEdit($id) {
        $data                = QUser::getByPk($id);
        //Utils::show($data,true);
        $this->current_title = $data['username'];
        return $this->render('edit', ['data' => $data]);
    }

    /**
     * Actualiza los datos de un usuario
     */
    public function actionUpdate() {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $id_user = Yii::$app->request->post("id_user");
            $type    = Yii::$app->request->post("type");
            switch ($type) {
                case 'general':
                    $general = Yii::$app->request->post("general");
                    var_dump($general['cod_per']);
                    break;
                case 'recovery':
                    break;
                case 'apps':
            }
            $transaction->commit();
            JSON::response(FALSE, 200, "Usuario actualizado con éxito", []);
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

            $id_user      = Yii::$app->request->post("id_user");
            $model        = User::findOne($id_user);
            $model->state = 0;

            if (!$model->update(['state'])) {
                throw new Exception("Error al eliminar el usuario ", 900);
            }

            $transaction->commit();
            JSON::response(FALSE, 200, "Usuario eliminado con éxito", []);
        } catch (Exception $ex) {
            $transaction->rollBack();
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

}
