<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;
use yii\web\AssetBundle;
/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'css/style.css',
    'css/flexslider.css',
    'css/memenu.css',
    'css/bootstrap.css',
    'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900',
    'https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900',
  ];

  public $js = [
    'js/classie.js',
    'js/imagezoom.js',
    'js/jquery.flexslider.js',
    'js/jquery.min.js',
    'js/main.js',
    'js/memenu.js',
    'js/responsiveslides.min.js',
    'js/simpleCart.min.js',
    'js/uisearch.js',
  ];

  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset',
    'yii\bootstrap4\BootstrapPluginAsset',
  ];
}
