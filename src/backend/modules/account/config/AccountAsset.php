<?php

namespace app\modules\account\config;

class AccountAsset
{
    public $js      = [];
    public $css     = [];
    public $depends = [];

    /**
     *
     * @var type 
     */
    public $controller = [
        "default" => [
            "js"      => ["controller"],
            "css"     => [],
            "depends" => [],
        ]
    ];
    /**
     *
     * @var type 
     */
    public $action     = [
        "default.index" => [
            "js"      => ["controller/action"],
            "css"     => [],
            "depends" => [],
        ]
    ];
    
}
