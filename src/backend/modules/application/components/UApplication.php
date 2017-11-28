<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\components;

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

}
