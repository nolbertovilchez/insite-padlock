<?php

namespace app\modules\user\controllers;

use app\components\JSON;
use app\components\Utils;
use Yii;

/**
 * Administrador de usuarios
 */
class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionList() {
        Utils::show("hola");
    }
    
    public function actionSave(){
        try{
            if (!Yii::$app->request->isAjax) {
                throw new Exception("El metodo no esta permitido", 403);
            }
            $nombres = Yii::$app->request->post("nombres");
            
            $response['data']['id'] = 1;
            JSON::response(FALSE, 200, "Usuario registrada con éxito", $response);
        } catch (Exception $ex) {
            JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
        }
    }

    public function actionEdit($id){
        Utils::show($id);
    }
}
