<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_recovery_option".
 *
 * @property integer $id_recovery
 * @property integer $id_user
 * @property string $email
 * @property string $number
 * @property integer $state
 */
class UserRecoveryOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_recovery_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user', 'state'], 'integer'],
            [['email', 'number'], 'string', 'max' => 50],
            ['email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_recovery' => 'Id Recovery',
            'id_user' => 'Id User',
            'email' => 'Email',
            'number' => 'Number',
            'state' => 'State',
        ];
    }
}