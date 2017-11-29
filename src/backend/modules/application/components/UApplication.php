<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\components;

use app\components\Chacad;

/**
 * Description of UApplication
 *
 * @author francisco
 */
class UApplication {

    public static function getAll() {
        return QApplication::getAll();
    }

    public static function getByPk($id) {
        return QApplication::getByPk($id);
    }

    public static function getRolesByApp($id_app) {
        $data = QApplication::getRolesByApp($id_app);

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "roles";
        }

        return $data;
    }

    public static function cboRolesByApp($id_app) {
        $data = QApplication::getRolesByApp($id_app);

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "roles";
        }

        return \yii\helpers\ArrayHelper::map($data, "id_role", "name");
    }

    public static function getActionsByApp($id_app) {
        $data = QApplication::getActionsByApp($id_app);

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "actions";
        }

        return $data;
    }

    public static function getOwnActionByRole($id_role) {
        $data = QApplication::getOwnActionByRole($id_role);

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "own";
        }

        return $data;
    }

    public static function getAvailableActionByRole($id_role) {
        $data = QApplication::getAvailableActionByRole($id_role);

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "available";
        }

        return $data;
    }

    public static function getUsersByApp($id_app) {
        $data = QApplication::getUsersByApp($id_app);

        foreach ($data as $key => $value) {
            $chacad                       = Chacad::getDatosPersonales($value['cod_per']);
            $data[$key]['nombre_persona'] = $chacad['nombre_persona'];
            $data[$key]['type']           = "users";
        }

        return $data;
    }

    public static function getUsersNoApp($id_app, $term) {
        $persons = Chacad::getPersons($term);

        $data = [];

        foreach ($persons as $key => $value) {
            $user = QApplication::getUsersByAppByCodper($id_app, $value['dni']);


            if ($user && $user['id_app_user'] == "") {
                $value['id_user'] = $user['id_user'];
                $data[]           = $value;
            }
        }

        foreach ($data as $key => $value) {
            $data[$key]['type'] = "users";
            $data[$key]['text'] = $value['label'];
            $data[$key]['id']   = $value['id_user'];
        }

        return $data;
    }

}
