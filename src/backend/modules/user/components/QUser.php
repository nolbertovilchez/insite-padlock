<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\components;

use Yii;

/**
 * Description of QApplication
 *
 * @author alvaro
 */
class QUser {

    public static function getAll() {
        $sql = "select * from user where state=1";
        $command =  Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    }

}
