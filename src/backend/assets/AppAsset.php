<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath   = '@webroot/static';
    public $baseUrl    = '@web/static';
    public $css        = [];
    public $js         = ["js/app.min.js"];
    public $depends    = [];
    public $jsOptions  = ['position' => \yii\web\View::POS_END];
    public $cssOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     *
     * @var type 
     */
    private $controller;
    private $action;
    private $module;

    private function changeModulebaseUrl($files, $ext) {
        foreach ($files as $key => $value) {
            $name = "{$value}.min.{$ext}";
            switch ($ext) {
                case "js":
                    $files[$key] = "{$ext}/{$this->module}/{$name}";
                    break;
                case "css":
                    $files[$key] = "{$ext}/{$this->module}/{$name}";
                    break;
            }
        }

        return $files;
    }

    private function registerJS($asset) {

        if (!empty($asset->controller) && isset($asset->controller[$this->controller]) && isset($asset->controller[$this->controller]["js"])) {
            $this->js = array_merge($this->js, $this->changeModulebaseUrl($asset->controller[$this->controller]["js"], "js"));
        }
        if (!empty($asset->action) && isset($asset->action["{$this->controller}.{$this->action}"]) && isset($asset->action["{$this->controller}.{$this->action}"]["js"])) {
            $this->js = array_merge($this->js, $this->changeModulebaseUrl($asset->action["{$this->controller}.{$this->action}"]["js"], "js"));
        }
    }

    private function registerCSS($asset) {
        if (!empty($asset->controller) && isset($asset->controller[$this->controller]) && isset($asset->controller[$this->controller]["css"])) {
            $this->css = array_merge($this->css, $this->changeModulebaseUrl($asset->controller[$this->controller]["css"], "css"));
        }
        if (!empty($asset->action) && isset($asset->action["{$this->controller}.{$this->action}"]) && isset($asset->action["{$this->controller}.{$this->action}"]["css"])) {
            $this->css = array_merge($this->css, $this->changeModulebaseUrl($asset->action["{$this->controller}.{$this->action}"]["css"], "css"));
        }
    }

    private function registerDepends($asset) {
        if (!empty($asset->controller) && isset($asset->controller[$this->controller]) && isset($asset->controller[$this->controller]["depends"])) {
            $this->depends = array_merge($this->depends, $asset->controller[$this->controller]["depends"]);
        }
        if (!empty($asset->action) && isset($asset->action["{$this->controller}.{$this->action}"]) && isset($asset->action["{$this->controller}.{$this->action}"]["depends"])) {
            $this->depends = array_merge($this->depends, $asset->action["{$this->controller}.{$this->action}"]["depends"]);
        }
    }

    public function init() {
        $this->controller = \yii::$app->controller->id;
        $this->action     = \yii::$app->controller->action->id;
        $this->module     = \yii::$app->controller->module->id;

        $class = "app\\modules\\" . $this->module . "\\config\\" . ucfirst($this->module) . "Asset";

        if (class_exists($class)) {
            $asset = new $class();

            $this->js      = array_merge($this->js, $this->changeModulebaseUrl($asset->js, "js"));
            $this->css     = array_merge($this->css, $this->changeModulebaseUrl($asset->css, "css"));
            $this->depends = array_merge($this->depends, $asset->depends);

            $this->registerCSS($asset);
            $this->registerJS($asset);
            $this->registerDepends($asset);
        }

        parent::init();
    }

}
