<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\application\components;

use Yii;
use yii\db\mssql\PDO;

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
        $command->bindParam(":id", $id, PDO::PARAM_INT);

        return $command->queryOne();
    }

    public static function getRolesByApp($id_app) {
        $sql     = "SELECT * from application_role where state = 1 and id_app = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getActionsByApp($id_app) {
        $sql     = "SELECT * from application_action where state = 1 and id_app = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getOwnActionByRole($id_role, $id_app) {
        $sql     = "select ap.*, aa.name 
                    from application_permit ap
                    inner join application_action aa on (
                        aa.id_action = ap.id_action
                        and aa.state = 1
                        and aa.id_app = :id_app
                    )
                    where ap.state = 1 and ap.id_role = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_role, PDO::PARAM_INT);
        $command->bindParam(":id_app", $id_app, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getAvailableActionByRole($id_role, $id_app) {
        $sql     = "select * from application_action where state = 1 and id_app = :id_app and id_action not in (select id_action from application_permit where state = 1 and id_role = :id)";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_role, PDO::PARAM_INT);
        $command->bindParam(":id_app", $id_app, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getUsersByApp($id_app) {
        $sql     = "SELECT 
                        au.*
                        ,ar.name as role
                        ,u.cod_per
                        ,(	
                            select 
                                GROUP_CONCAT(aa.name SEPARATOR ', ')
                            from application_user_permit_additional aupa 
                            inner join application_action aa on (
                            aa.id_action = aupa.id_action
                            and aa.state = 1
                            )
                            where aupa.state = 1 and aupa.id_app_user =au.id_app_user
                        ) as actions_allowed
                        ,(
                            select 
                                GROUP_CONCAT(aa.name SEPARATOR ', ')
                            from application_user_permit_restricted aupr 
                            inner join application_permit ap on (
                                ap.id_permit = aupr.id_permit
                                and ap.state = 1
                            )
                            inner join application_action aa on (
                                aa.id_action = ap.id_action
                                and aa.state = 1
                            )
                            where aupr.state = 1 and aupr.id_app_user =au.id_app_user
                        ) as actions_restricted
                    from application_user au
                    inner join application_role ar ON (
                        ar.id_role = au.id_role
                        and ar.id_app = au.id_app
                        and ar.state = 1
                    )
                    inner join user u ON (
                        u.id_user = au.id_user
                        and u.state  = 1
                        and u.state_user = 1
                    )
                    where au.state = 1 and au.id_app = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app, PDO::PARAM_INT);

        return $command->queryAll();
    }
    
    public static function getUsersByAppByCodper($id_app, $cod_per) {
        $sql     = "SELECT 
                    au.id_app_user
                    ,au.id_app
                    ,au.id_role
                    ,u.id_user
                    ,u.cod_per
                    from user u
                    left join application_user au ON (
                        u.id_user = au.id_user
                        and au.id_app = :id 
                        and au.state = 1
                    )
                    where u.state  = 1 and u.state_user = 1 and u.cod_per = :codper";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app, PDO::PARAM_INT);
        $command->bindParam(":codper", $cod_per, PDO::PARAM_STR);

        return $command->queryOne();
    }

    public static function getActionsPermitAvailable($id_app_user) {
        $sql     = "select 
                        au.id_app_user
                        ,au.id_app
                        ,au.id_role
                        ,au.id_user
                        ,aa.id_action
                        ,aa.name
                    from application_user au
                    inner join application_action aa on (
                    aa.id_app = au.id_app
                    and aa.state = 1
                    and aa.id_action not in (select id_action from application_permit ap where ap.id_role = au.id_role and ap.state = 1)
                    and aa.id_action not in (select id_action from application_user_permit_additional aupa where aupa.id_app_user = au.id_app_user and aupa.state = 1)
                    )
                    where au.id_app_user = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app_user, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getActionsPermitOwn($id_app_user) {
        $sql     = "select 
                        aupa.*
                        ,aa.name
                    from application_user_permit_additional aupa 
                    inner join application_action aa on (
                    aa.id_action = aupa.id_action
                    and aa.state = 1
                    )
                    where aupa.state = 1 and aupa.id_app_user = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app_user, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getActionsPermitAllow($id_app_user) {
        $sql     = "select 
                        au.id_app_user
                        ,au.id_app
                        ,au.id_role
                        ,au.id_user
                        ,ap.id_permit
                        ,aa.id_action
                        ,aa.name
                    from application_user au
                    left join application_action aa on (
                    aa.id_app = au.id_app
                    and aa.state = 1
                    and aa.id_action in (select id_action from application_permit ap where ap.id_role = au.id_role and ap.state = 1)
                    )
                    inner join application_permit ap on (
                        ap.id_action = aa.id_action
                        and ap.id_role = au.id_role
                        and ap.state = 1
                        and ap.id_permit not in (select id_permit from application_user_permit_restricted aupr where aupr.id_app_user = au.id_app_user and aupr.state = 1)
                    )
                    where au.id_app_user = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app_user, PDO::PARAM_INT);

        return $command->queryAll();
    }

    public static function getActionsPermitRestricted($id_app_user) {
        $sql     = "select 
                        aupr.*
                        ,aa.id_action
                        ,aa.name
                    from application_user_permit_restricted aupr 
                    inner join application_permit ap on (
                        ap.id_permit = aupr.id_permit
                        and ap.state = 1
                    )
                    inner join application_action aa on (
                        aa.id_action = ap.id_action
                        and aa.state = 1
                    )
                    where aupr.state = 1 and aupr.id_app_user = :id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(":id", $id_app_user, PDO::PARAM_INT);

        return $command->queryAll();
    }

}
