<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'assets_ui/css/icons.min.css',
        'assets_ui/css/app.min.css',
        // 'assets_ui/css/app-dark.min.css',
        'assets_ui/css/vendor/dataTables.bootstrap5.css',
        'assets_ui/css/vendor/responsive.bootstrap5.css',
        'assets_ui/images/favicon.ico',
    ];
    public $js = [    
        'assets_ui/js/vendor.min.js',
        'assets_ui/js/app.min.js',
        'assets_ui/js/vendor/Chart.bundle.min.js',
        'assets_ui/js/pages/demo.dashboard-projects.js',
        'assets_ui/js/vendor/jquery.dataTables.min.js',
        'assets_ui/js/vendor/dataTables.bootstrap5.js',
        'assets_ui/js/vendor/dataTables.responsive.min.js',
        'assets_ui/js/vendor/responsive.bootstrap5.min.js',
        'assets_ui/js/vendor/dataTables.checkboxes.min.js',
        'assets_ui/js/vendor/apexcharts.min.js',
        'assets_ui/js/pages/demo.customers.js',
        'assets_ui/js/pages/demo.dashboard.js',
        'assets_ui/js/main.js',
        'assets_ui/js/popper.min.js',
        'assets_ui/js/bootbox.min.js',
        'assets_ui/js/confirmSwal.js',
        "assets_ui/js/pages/demo.typehead.js",
        "assets_ui/js/pages/demo.timepicker.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap4\BootstrapAsset',
    ];
}
