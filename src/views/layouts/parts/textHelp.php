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
use yii\helpers\FileHelper;

/* @var $this \yii\web\View */

if (array_key_exists('textHelp', $this->params) && isset($this->params['textHelp']['filename'])) {
    $text = trim($this->renderPhpFile(
            FileHelper::localize($this->context->getViewPath().DIRECTORY_SEPARATOR.'help'.DIRECTORY_SEPARATOR.$this->params['textHelp']['filename'].'.php'),
            $this->params['textHelp']
    ));
    if (!empty($text) && strlen($text) > 0) {
        echo '<div class="text-help-layout col-xs-12">'.$text.'</div>';
    }
}
