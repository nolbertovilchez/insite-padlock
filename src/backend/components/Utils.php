<?php

namespace app\components;

use Yii;

/**
 * Utils es la clase creada para colocar funciones reutilizables
 * 
 * Vease a esta clase como un Helper o Utilitarios que permite concentrar
 * todas las funciones que son de uso cotidiano y utilizado por todos.
 *
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package UPCH\Components
 */
class Utils {

    public static function host($url = "", $baseUrl = false) {
        if ($baseUrl) {
            return Yii::$app->request->hostInfo . Yii::$app->baseUrl . $url;
        }
        return Yii::$app->request->hostInfo . $url;
    }

    public static function show($data, $detenerProcesos = false, $titulo = 'Datos') {
        echo "<code class='code'><b>{$titulo} :</b></code>";
        echo "<pre>";
        print_r($data);
        echo '</pre>';
        if ($detenerProcesos) {
            die();
        }
    }

    public static function _get($nombreGet) {
        if (!isset($_GET[$nombreGet])) {
            return null;
        }
        return $_GET[$nombreGet];
    }

}
