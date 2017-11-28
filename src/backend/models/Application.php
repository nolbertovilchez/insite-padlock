<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property integer $id_app
 * @property string $name
 * @property string $key
 * @property string $secretkey
 * @property string $url
 * @property string $image
 * @property integer $state_app
 * @property integer $state
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'secretkey'], 'required'],
            [['state_app', 'state'], 'integer'],
            [['name', 'key', 'secretkey'], 'string', 'max' => 100],
            [['url', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_app' => 'Id App',
            'name' => 'Name',
            'key' => 'Key',
            'secretkey' => 'Secretkey',
            'url' => 'Url',
            'image' => 'Image',
            'state_app' => 'State App',
            'state' => 'State',
        ];
    }
}
