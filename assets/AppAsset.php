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
        'libs/jquery-ui/jquery-ui.min.css',
        'libs/tag-it/css/jquery.tagit.css',
        'libs/tag-it/css/tagit.ui-zendesk.css',
        'libs/spectrum-colorpicker/spectrum.css',
    ];
    public $js = [
        
        'libs/jquery-ui/jquery-ui.min.js',
        'libs/tag-it/js/tag-it.js',
        'libs/spectrum-colorpicker/spectrum.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
