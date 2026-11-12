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

use yii\web\AssetBundle;

/**
 * Class BootstrapItaliaCustomAsset
 * @package open20\amos\layout\assets
 */

class BootstrapItaliaCustomAsset extends AssetBundle
{
    public $sourcePath = '@vendor/open20/amos-layout/src/assets/resources/bootstrap-italia-custom';

    public $js = [
        'js/bootstrap-italia-custom.js',
        'node_modules/svgxuse/svgxuse.min.js', //per far vedere le icone in IE
        'https://use.fontawesome.com/releases/v5.3.1/js/all.js', // fix temporaneo per icone kartik font-awesome
    ];

    public $css = [
      'scss/main-amos-layout.scss',
      'https://use.fontawesome.com/releases/v5.3.1/css/all.css', // fix temporaneo per icone kartik font-awesome
    ];

    public $depends = [
        'open20\amos\layout\assets\FontAsset', //fix temp font
        'open20\amos\layout\assets\IconAsset', // Retrocompatibilità icone
        'yii\bootstrap4\BootstrapPluginAsset'
    ];
}
