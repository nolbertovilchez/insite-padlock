<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_role".
 *
 * @property integer $id_role
 * @property integer $id_app
 * @property string $name
 * @property string $description
 * @property integer $state
 * @property integer $hierarchy
 * @property string $code_role
 */
class ApplicationRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app', 'name'], 'required'],
            [['id_app', 'state', 'hierarchy'], 'integer'],
            [['description'], 'string'],
            [['name', 'code_role'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_role' => 'Id Role',
            'id_app' => 'Id App',
            'name' => 'Name',
            'description' => 'Description',
            'state' => 'State',
            'hierarchy' => 'Hierarchy',
            'code_role' => 'Code Role',
        ];
    }
}
