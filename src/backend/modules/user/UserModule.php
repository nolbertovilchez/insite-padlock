<?php

namespace app\modules\user;

/**
 * user module definition class
 * Modulo para la creacion de usarios y asignacion de aplicaciones y permisos.
 */
class UserModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
