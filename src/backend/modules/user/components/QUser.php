<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\components;

use Yii;
use \yii\db\mssql\PDO;

/**
 * Description of QApplication
 *
 * @author alvaro
 */
class QUser {

    public static function getAll() {
        $sql     = "select * from user where state=1";
        $command = Yii::$app->db->createCommand($sql);
        return $command->queryAll();
    }

    public static function getByPk($id) {
        $sql     = "
            select 
                a.id_user,
                a.cod_per,
                a.id_type_user,
                a.username,
                a.password,
                a.state_user,
                b.id_recovery,
                b.email,
                b.number
            from user a 
            left join user_recovery_option b
                on a.id_user=b.id_user
            where a.id_user=:id_user";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id_user", $id, PDO::PARAM_STR);

        return $command->queryOne();
    }

}
