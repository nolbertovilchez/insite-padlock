<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\components;

/**
 * Description of UUser
 *
 * @author alvaro
 */
class ManageUser {

    public static function create($cod_per) {
        $response = array();
        return $response;
    }

    public static function delete($id_user) {
        $response    = array('status' => false, 'message' => array());
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model        = User::findOne($id_user);
            $model->state = 0;

            if (!$model->update(['state'])) {
                $response['message'] = "Error al eliminar el usuario";
            }

            $transaction->commit();
            $response['status']  = true;
            $response['message'] = "Usuario eliminado con éxito";
        } catch (Exception $ex) {
            $transaction->rollBack();
            //JSON::response(TRUE, $ex->getCode(), $ex->getMessage(), []);
            $response['message'] = $ex->getMessage();
        }
        return $response;
    }

}
