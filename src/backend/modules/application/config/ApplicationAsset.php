<?php

namespace app\modules\application\config;

class ApplicationAsset {

    public $js      = [];
    public $css     = [];
    public $depends = [];

    /**
     *
     * @var type 
     */
    public $controller = [
        "manage" => [
            "js"      => ["manage"],
            "css"     => [],
            "depends" => [
                'insite\asset\BootstrapTable',
                'insite\asset\JqueryValidation'
            ],
        ]
    ];

    /**
     *
     * @var type 
     */
    public $action = [
        "manage.index" => [
            "js"      => ["manage/list"],
            "css"     => [],
            "depends" => [],
        ],
        "manage.edit" => [
            "js"      => ["manage/update","manage/permissions"],
            "css"     => [],
            "depends" => [],
        ]
    ];

}
