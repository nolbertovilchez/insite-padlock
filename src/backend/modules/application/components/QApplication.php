<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\components;

use Yii;

/**
 * Description of QApplication
 *
 * @author francisco
 */
class QApplication {

    public static function getAll() {


        $sql     = "SELECT * from application where state = 1";
        $command = Yii::$app->db->createCommand($sql);

        return $command->queryAll();
    }

    public static function getByPk($id) {
        $sql     = "
            SELECT 
                app.id_app
                ,app.name
                ,app.secretkey
                ,app.key
                ,app.url
                ,app.image
                ,app.state
                ,app.state_app
                ,apc.id_config
                ,apc.session_max_duration_mins 
                ,apc.session_max_same_ip_connections
                ,apc.session_reuse_sessions
                ,apc.session_max_sessions_per_day
                ,apc.session_max_sessions_per_user
                ,apc.system_no_new_sessions
            from application app 
            left join application_configuration apc ON (
                apc.id_app = app.id_app
                and apc.state = 1
            )
            where app.state = 1 and app.id_app = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id, \yii\db\mssql\PDO::PARAM_STR);

        return $command->queryOne();
    }

    public static function getRolesByApp($id_app) {
        $sql     = "SELECT * from application_role where state = 1 and id_app = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app, \yii\db\mssql\PDO::PARAM_INT);

        return $command->queryAll();
    }

}
