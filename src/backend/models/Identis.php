<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "dbo.Identis".
 *
 * @property string $CodIden
 * @property string $Ape1
 * @property string $Ape2
 * @property string $Nombres
 * @property string $FNacio
 * @property string $Sexo
 * @property string $CodTMoti
 * @property string $FCambio
 * @property string $CodUbiNac
 * @property string $FReg
 * @property string $CodPer
 * @property string $codper_ant
 */
class Identis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dbo.Identis';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('chacad');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ape1', 'Nombres', 'Sexo', 'FReg', 'CodPer'], 'required'],
            [['CodIden', 'Ape1', 'Ape2', 'Nombres', 'Sexo', 'CodTMoti', 'CodUbiNac', 'CodPer', 'codper_ant'], 'string'],
            [['FNacio', 'FCambio', 'FReg'], 'safe'],
            //[['CodPer'], 'exist', 'skipOnError' => true, 'targetClass' => Pers::className(), 'targetAttribute' => ['CodPer' => 'CodPer']],
            //[['CodUbiNac'], 'exist', 'skipOnError' => true, 'targetClass' => Ubis::className(), 'targetAttribute' => ['CodUbiNac' => 'CodUbi']],
            //[['CodTMoti'], 'exist', 'skipOnError' => true, 'targetClass' => TMotiChg::className(), 'targetAttribute' => ['CodTMoti' => 'CodTMoti']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CodIden' => 'Cod Iden',
            'Ape1' => 'Ape1',
            'Ape2' => 'Ape2',
            'Nombres' => 'Nombres',
            'FNacio' => 'Fnacio',
            'Sexo' => 'Sexo',
            'CodTMoti' => 'Cod Tmoti',
            'FCambio' => 'Fcambio',
            'CodUbiNac' => 'Cod Ubi Nac',
            'FReg' => 'Freg',
            'CodPer' => 'Cod Per',
            'codper_ant' => 'Codper Ant',
        ];
    }
}