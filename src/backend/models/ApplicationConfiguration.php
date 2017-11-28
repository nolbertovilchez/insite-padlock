<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application_configuration".
 *
 * @property integer $id_config
 * @property integer $id_app
 * @property integer $session_max_duration_mins
 * @property integer $session_max_same_ip_connections
 * @property integer $session_reuse_sessions
 * @property integer $session_max_sessions_per_day
 * @property integer $session_max_sessions_per_user
 * @property integer $system_no_new_sessions
 * @property integer $state
 */
class ApplicationConfiguration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_configuration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_app'], 'required'],
            [['id_app', 'session_max_duration_mins', 'session_max_same_ip_connections', 'session_reuse_sessions', 'session_max_sessions_per_day', 'session_max_sessions_per_user', 'system_no_new_sessions', 'state'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_config' => 'Id Config',
            'id_app' => 'Id App',
            'session_max_duration_mins' => 'Session Max Duration Mins',
            'session_max_same_ip_connections' => 'Session Max Same Ip Connections',
            'session_reuse_sessions' => 'Session Reuse Sessions',
            'session_max_sessions_per_day' => 'Session Max Sessions Per Day',
            'session_max_sessions_per_user' => 'Session Max Sessions Per User',
            'system_no_new_sessions' => 'System No New Sessions',
            'state' => 'State',
        ];
    }
}
