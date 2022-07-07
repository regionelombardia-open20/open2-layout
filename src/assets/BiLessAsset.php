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

use open20\amos\core\widget\WidgetAbstract;
use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package open20\amos\layout\assets
 */
class BiLessAsset extends AssetBundle
{
    public $js = [
        'js/header.js',
        'js/footer.js',
        'js/hamburger-menu.js',
    ];

    public $css = [
        'less/main-bi.less'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/base';
        
        parent::init();
    }
}
