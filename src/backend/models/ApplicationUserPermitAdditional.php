<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_user_permit_additional".
 *
 * @property integer $id_user_permit_add
 * @property integer $id_app_user
 * @property integer $id_action
 * @property integer $state_permits_add
 * @property integer $state
 * @property string $date_user_permit_add
 */
class ApplicationUserPermitAdditional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_user_permit_additional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app_user', 'id_action'], 'required'],
            [['id_app_user', 'id_action', 'state_permits_add', 'state'], 'integer'],
            [['date_user_permit_add'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user_permit_add' => 'Id User Permit Add',
            'id_app_user' => 'Id App User',
            'id_action' => 'Id Action',
            'state_permits_add' => 'State Permits Add',
            'state' => 'State',
            'date_user_permit_add' => 'Date User Permit Add',
        ];
    }
}
