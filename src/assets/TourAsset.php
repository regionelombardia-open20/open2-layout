<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\layout
 * @category   CategoryName
 */

namespace open20\amos\layout\assets;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package open20\amos\layout\assets
 */

class TourAsset extends AssetBundle {

    public $sourcePath = '@bower/bootstrap-tour';
    public $js = [
        'build/js/bootstrap-tour.min.js',
    ];
    public $css = [
        'build/css/bootstrap-tour.min.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
