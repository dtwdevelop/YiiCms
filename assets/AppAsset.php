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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
         'js/fancybox/jquery.fancybox.css',
         'js/taginput/src/jquery.taginput.css',
    ];
    public $js = [
        'js/ckeditor/ckeditor.js',
         'js/ckeditor/adapters/jquery.js',
         'js/fancybox/jquery.fancybox.js',
         'js/taginput/src/jquery.taginput.src.js',
         'js/lib.js'
         
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
