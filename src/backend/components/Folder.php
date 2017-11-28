<?php

namespace app\components;

/**
 * Description of Folder
 *
 * @author Nolberto Vilchez Moreno <jnolbertovm@gmail.com>
 * @package UPCH\Components
 */
class Folder {

    /**
     * Funcion:     existeCarpeta
     * Param:       urlServer
     * Descripcion: Se entrega la url absoluta de la carpeta que se quiere verificar su existencia, si no existe se procede a crear la carpeta.
     */
    public static function create($urlDIr, $recursivo = true) {
        if (!is_dir($urlDIr)) {
            return mkdir($urlDIr, 0777, $recursivo);
        }
        return true;
    }

    /*
     * Funcion:     deleteDir
     * Param:       dirPath
     * Descripcion: Se recibe la url de la carpeta a eliminar con todos sus hijos correspondientes
     */

    public static function delete($dirPath) {
        if (!is_dir($dirPath)) {
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::delete($file);
            } else {
                unlink($file);
            }
        }
        return rmdir($dirPath);
    }

}
