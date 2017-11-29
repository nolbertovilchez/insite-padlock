<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_user_permit_restricted".
 *
 * @property integer $id_user_permit_del
 * @property integer $id_app_user
 * @property integer $id_permit
 * @property integer $state_permit_del
 * @property integer $state
 */
class ApplicationUserPermitRestricted extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_user_permit_restricted';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app_user', 'id_permit'], 'required'],
            [['id_app_user', 'id_permit', 'state_permit_del', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user_permit_del' => 'Id User Permit Del',
            'id_app_user' => 'Id App User',
            'id_permit' => 'Id Permit',
            'state_permit_del' => 'State Permit Del',
            'state' => 'State',
        ];
    }
}
