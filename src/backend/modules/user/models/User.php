<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id_user
 * @property string $cod_per
 * @property integer $id_type_user
 * @property string $username
 * @property string $password
 * @property integer $state_user
 * @property integer $state
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cod_per', 'id_type_user', 'username', 'password'], 'required'],
            [['id_type_user', 'state_user', 'state'], 'integer'],
            [['cod_per'], 'string', 'max' => 20],
            [['username', 'password'], 'string', 'max' => 100],
            ['username', 'validateUsername', 'on' => 'create']
        ];
    }

    public function validateUsername($attribute, $params, $validator) {
        if (self::find()->where(['username' => $this->$attribute])->one()) {
            $this->addError($attribute, 'El username ya existe.');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_user'      => 'Id User',
            'cod_per'      => 'Cod Per',
            'id_type_user' => 'Id Type User',
            'username'     => 'Username',
            'password'     => 'Password',
            'state_user'   => 'State User',
            'state'        => 'State',
        ];
    }

}
