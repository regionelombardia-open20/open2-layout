<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\core
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

use Yii;
use yii\web\AssetBundle;

class AmosCalendarCoreAsset extends AssetBundle
{
    /**
     * [$sourcePath description]
     * @var string
     */
    public $sourcePath = '@bower/fullcalendar/dist';

    /**
     * the language the calender will be displayed in
     * @var string ISO2 code for the wished display language
     */
    public $language = NULL;

    /**
     * [$autoGenerate description]
     * @var boolean
     */
    public $autoGenerate = true;

    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar = false;

    /**
     * [$css description]
     * @var array
     */
    public $css = [
        'fullcalendar.min.css',
    ];

    /**
     * [$js description]
     * @var array
     */
    public $js = [
        'locale-all.js',
    ];

    /**
     * [$depends description]
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii2fullcalendar\MomentAsset',
        'yii2fullcalendar\PrintAsset',
        'open20\amos\layout\assets\AmosCalendarAsset'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $language = Yii::$app->language == 'it-IT' ? 'it' : strtolower(Yii::$app->language);
        //$language = $this->language ? $this->language : Yii::$app->language;
        if (strtoupper($language) != 'EN-US')
        {
            $this->js[] = strtolower("locale/{$language}.js");
        }

        if($this->googleCalendar)
        {
            $this->js[] = 'gcal.js';
        }

        parent::registerAssetFiles($view);
    }
}
