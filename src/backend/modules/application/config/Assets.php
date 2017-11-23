<?php

namespace app\modules\application\config;

use app\assets\AppAsset;

class Assets extends AppAsset {
    
    public $sourcePath = '@vendor/insite/yii2-theme-espire/dist';

    public $js = [];
    public $css = [];
    public $depends = ["insite\asset\BootstrapTable"];

    /**
     *
     * @var type 
     */
    public $controller = [
        "manage" => [
            "js" => ["manage.min.js"],
            "css" => [],
            "depends" => [],
        ]
    ];
    public $action = [
        "manage.index" => [
            "js" => ["list.min.js"],
            "css" => [],
            "depends" => ["jquery-validation", "bootstrap-table", "tables"],
        ],
    ];

}
