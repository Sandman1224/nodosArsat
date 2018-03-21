<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Description of MapAsset
 *
 * @author Tinch
 */
class MapAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/gmaps.css',
    ];
    public $js = [
        'js/gmaps.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $jsOptions = ['position' => View::POS_HEAD];
}
