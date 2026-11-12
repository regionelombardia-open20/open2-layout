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
 * Class BootstrapItaliaAsset
 * @package open20\amos\layout\assets
 */

class BootstrapItaliaAsset extends AssetBundle {

    public $sourcePath = '@vendor/open20/amos-layout/src/assets/resources/bootstrap-italia-custom';
    public $js = [
//        'node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js',
        'node_modules/bootstrap-italia/src/js/plugins/autocomplete.js',
        'node_modules/bootstrap-italia/src/js/plugins/back-to-top.js',
        'node_modules/bootstrap-italia/src/js/plugins/carousel.js',
        'node_modules/bootstrap-italia/src/js/plugins/componente-base.js',
        'node_modules/bootstrap-italia/src/js/plugins/cookiebar.js',
        'node_modules/bootstrap-italia/src/js/plugins/custom-select.js',
        'node_modules/bootstrap-italia/src/js/plugins/dimmer.js',
        'node_modules/bootstrap-italia/src/js/plugins/dropdown.js',
        'node_modules/bootstrap-italia/src/js/plugins/fonts-loader.js',
        'node_modules/bootstrap-italia/src/js/plugins/forms.js',
        'node_modules/bootstrap-italia/src/js/plugins/forward.js',
        'node_modules/bootstrap-italia/src/js/plugins/history-back.js',
        'node_modules/bootstrap-italia/src/js/plugins/ie.js',
        'node_modules/bootstrap-italia/src/js/plugins/imgresponsive.js',
        'node_modules/bootstrap-italia/src/js/plugins/input-number.js',
        'node_modules/bootstrap-italia/src/js/plugins/list.js',
        'node_modules/bootstrap-italia/src/js/plugins/navbar.js',
        'node_modules/bootstrap-italia/src/js/plugins/navscroll.js',
        'node_modules/bootstrap-italia/src/js/plugins/notifications.js',
        'node_modules/bootstrap-italia/src/js/plugins/progress-donut.js',
        'node_modules/bootstrap-italia/src/js/plugins/rating.js',
        'node_modules/bootstrap-italia/src/js/plugins/select.js',
        'node_modules/bootstrap-italia/src/js/plugins/sticky-header.js',
        'node_modules/bootstrap-italia/src/js/plugins/sticky-wrapper.js',
        'node_modules/bootstrap-italia/src/js/plugins/timepicker.js',
        'node_modules/bootstrap-italia/src/js/plugins/track-focus.js',
        'node_modules/bootstrap-italia/src/js/plugins/transfer.js',
        'node_modules/bootstrap-italia/src/js/plugins/upload.js',

        'node_modules/bootstrap-italia/src/js/plugins/circular-loader/CircularLoader-v1.3',
        'node_modules/bootstrap-italia/src/js/plugins/datepicker/datepicker.js',
        'node_modules/bootstrap-italia/src/js/plugins/datepicker/locales/it.js',
        'node_modules/bootstrap-italia/src/js/plugins/i-sticky/i-sticky.js',
        'node_modules/bootstrap-italia/src/js/plugins/password-strength-meter/password-strength-meter.js',
        'node_modules/bootstrap-italia/src/js/plugins/polyfills/array.from.js',
    ];



    public $css = [
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

}
