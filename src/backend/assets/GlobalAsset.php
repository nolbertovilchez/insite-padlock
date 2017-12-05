<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of GlobalAssets
 *
 * @author francisco
 */
class GlobalAsset extends AssetBundle {

    public $basePath   = '@webroot/static';
    public $baseUrl    = '@web/static';
    public $css        = [];
    public $js         = ["js/global/permits.min.js"];
    public $depends    = ["app\assets\AppAsset"];
    public $jsOptions  = ['position' => \yii\web\View::POS_END];
    public $cssOptions = ['position' => \yii\web\View::POS_HEAD];

}
