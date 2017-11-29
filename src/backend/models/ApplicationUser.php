<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_user".
 *
 * @property integer $id_app_user
 * @property integer $id_app
 * @property integer $id_user
 * @property integer $id_role
 * @property integer $state
 */
class ApplicationUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app', 'id_user', 'id_role'], 'required'],
            [['id_app', 'id_user', 'id_role', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_app_user' => 'Id App User',
            'id_app' => 'Id App',
            'id_user' => 'Id User',
            'id_role' => 'Id Role',
            'state' => 'State',
        ];
    }
}
