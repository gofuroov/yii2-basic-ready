<?php
/**
 * @author Olimjon G'ofurov <gofuroov@gmail.com>
 * Date: 14/11/21
 * Time: 14:42
 */

namespace app\assets;

use yii\bootstrap5\BootstrapAsset;
use yii\web\YiiAsset;

class AdminLteAsset extends \yii\web\AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/custom';

    public $css = [
        'adminlte/plugins/fontawesome-free-6.1/css/all.min.css',
        'adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'adminlte/css/adminlte.min.css',
        'adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'css/site.css',
        'css/custom.css'
    ];
    public $js = [
        'adminlte/plugins/jquery-ui/jquery-ui.min.js',
        'adminlte/plugins/jquery-knob/jquery.knob.min.js',
        'adminlte/plugins/moment/moment.min.js',
        'adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'js/bootstrap5.js',
        'adminlte/js/adminlte.js',
        'js/bootstrap.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}