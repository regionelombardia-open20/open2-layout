<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\layout
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

namespace open20\amos\layout\assets;

use open20\amos\core\widget\WidgetAbstract;
use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package open20\amos\layout\assets
 */
class BaseAsset extends AssetBundle
{
    public $js = [
        'js/bootstrap-tabdrop.js',
        'js/globals.js',
        'js/device-detect.js',
        'js/tooltip-component.js',
        'js/footer.js',
        'js/header.js',
    ];

    public $css = [
        'less/main.less'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
        'open20\amos\layout\assets\LajaxAsset',
        'yii\bootstrap\BootstrapAsset',
        'kartik\select2\Select2Asset',
        'open20\amos\layout\assets\IEAssets',
        'open20\amos\layout\assets\JqueryUiTouchPunchImprovedAsset',
        'open20\amos\layout\assets\ConflictJuiBootstrap',
        'open20\amos\layout\assets\TourAsset',
        'open20\amos\layout\assets\IconAsset',
        'open20\amos\layout\assets\FontAsset',
        'open20\amos\layout\assets\DialogAsset',
        'open20\amos\layout\assets\LajaxAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = __DIR__ . '/resources/base';
        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/main_fullsize.less'];
        }
        parent::init();
    }
}
