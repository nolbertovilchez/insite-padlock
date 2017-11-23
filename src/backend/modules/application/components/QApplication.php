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


        $sql = "SELECT * from APPLICATIONS";
        $command =  Yii::$app->db->createCommand($sql);
        
        return $command->queryAll();
                
    }

}
