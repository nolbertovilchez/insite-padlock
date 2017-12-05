<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use Yii;

/**
 * Description of Chacad
 *
 * @author francisco
 */
class Chacad {

    /**
     * Funcion para buscar personas.
     * @param string $term Termino de busqueda
     * @return array queryAll
     */
    public static function getPersons($term) {
        $sql = "SELECT 
                    usuarios.dni, usuarios.nombre_persona, usuarios.dni+' '+usuarios.nombre_persona as label
                FROM
                    (select 
                            persona.CodPer as dni
                            ,persona.Nombres
                            ,persona.Ape1
                            ,persona.Ape2
                            ,(RTRIM(persona.Nombres)+' '+RTRIM(persona.Ape1)+' '+RTRIM(persona.Ape2)) as nombre_persona
                    from dbo.Identis persona
                    left join dbo.permis usuario ON(
                            persona.CodPer = usuario.LogIn
                    )
                    where usuario.FHasta >= GETDATE()
                ) usuarios
                WHERE usuarios.nombre_persona+usuarios.dni LIKE '%{$term}%'
                group BY usuarios.dni, usuarios.nombre_persona ";

        $command = Yii::$app->chacad->createCommand($sql);
        return $command->queryAll();
    }

    public static function getDatosPersonales($codPer) {
        $sql = "select 
                    persona.CodIden
                    ,persona.CodPer as dni
                    ,RTRIM(persona.Nombres) as Nombres
                    ,RTRIM(persona.Ape1) as Ape1
                    ,RTRIM(persona.Ape2) as Ape2
                    ,persona.FNacio
                    ,persona.Sexo
                    ,(RTRIM(persona.Nombres)+' '+RTRIM(persona.Ape1)+' '+RTRIM(persona.Ape2)) as nombre_persona
                    ,(select RTRIM(Valor) from dbo.MedioCom where CodPer = persona.CodPer and CodTCom = 'C1') as telefono_personal
                    ,(select RTRIM(Valor) from dbo.MedioCom where CodPer = persona.CodPer and CodTCom = 'E1') as email_personal
                from dbo.Identis persona
                where persona.CodPer = '{$codPer}';";

        $command = Yii::$app->chacad->createCommand($sql);
        $data    = $command->queryOne();

        return $data;
    }

    public static function generateIdentisCodIden() {
        $sql     = "SELECT max(convert(int,codiden))+1 as CodeIden FROM dbo.identis WHERE CodIden<>'*****'";
        $command = Yii::$app->chacad->createCommand($sql);
        $data    = $command->queryScalar();
        return $data;
    }

}
