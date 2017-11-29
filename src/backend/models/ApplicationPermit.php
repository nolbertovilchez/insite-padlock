<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_permit".
 *
 * @property integer $id_permit
 * @property integer $id_role
 * @property integer $id_action
 * @property integer $state_permit
 * @property integer $state
 */
class ApplicationPermit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_permit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_role', 'id_action'], 'required'],
            [['id_role', 'id_action', 'state_permit', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_permit' => 'Id Permit',
            'id_role' => 'Id Role',
            'id_action' => 'Id Action',
            'state_permit' => 'State Permit',
            'state' => 'State',
        ];
    }
}
