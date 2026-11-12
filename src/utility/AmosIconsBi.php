<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-layout
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


namespace open20\amos\layout\utility;


use open20\amos\core\helpers\Html;
use open20\amos\layout\assets\BootstrapItaliaCustomSpriteAsset;

class AmosIconsBi
{
    /**
     * @param $name
     * @param string $type
     * @return string
     */
    public static function show($name, $type = 'secondary'){
        if($type == 'danger'){
            $class = 'rounded-danger';
        }
        else if ($type == 'primary') {
            $class = 'rounded-primary';
        }
        else {
            $class = 'rounded-secondary';
        }
        $spriteAsset = BootstrapItaliaCustomSpriteAsset::register(\Yii::$app->controller->getView());
        $icon = "<use xlink:href=" .  $spriteAsset->baseUrl . "/material-sprite.svg#$name></use>";
        $svgIcon = Html::tag('svg', $icon, ['class' => 'icon icon-white']);
        $spanSvgIcon = Html::tag('span', $svgIcon, ['class' => "rounded-icon $class p-1"]);

        return $spanSvgIcon;
    }

}