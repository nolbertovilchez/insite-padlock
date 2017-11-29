<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_action".
 *
 * @property integer $id_action
 * @property integer $id_app
 * @property string $name
 * @property string $description
 * @property integer $state
 */
class ApplicationAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app', 'name'], 'required'],
            [['id_app', 'state'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_action' => 'Id Action',
            'id_app' => 'Id App',
            'name' => 'Name',
            'description' => 'Description',
            'state' => 'State',
        ];
    }
}
