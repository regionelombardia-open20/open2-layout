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

use yii\widgets\Breadcrumbs;
use open20\amos\core\helpers\Html;

$urlCorrente = yii\helpers\Url::current();
$posizioneEsclusione = strpos($urlCorrente, '?');
$urlParametro = $urlCorrente;
if ($posizioneEsclusione > 0) {
    $urlParametro = preg_quote(substr($urlCorrente, 0, $posizioneEsclusione));
}
$urlFaq = Yii::$app->getUrlManager()->createUrl(['/faq/faq', 'FaqSearch[rotte]' => $urlParametro]);
?>


    <div class="breadcrumb_left">
        <?=
        Breadcrumbs::widget([
            'encodeLabels' => false,
            'homeLink' => [
                'label' => (!empty(\Yii::$app->params['homeName'])? \Yii::$app->params['homeName'] : \Yii::t('amoscore', 'Dashboard')),
                'url' => Yii::$app->homeUrl,
                'encode' => false
            ],
            'links' => [
//                [
//                    'label' => 'Classi Utenti e Ruoli',
//                    'url' => '/classiutenti/classi-utenti'
//                ],
                [
                    'label' => isset($this->params['breadcrumbs']) ? $this->title : '',
                ],               
            ]
        ])
        ?>
    </div>
<!--    <div id="bk-generalTools" class="show breadcrumb-tools">
        <a href="<?php // $urlFaq; ?>"><button>
                <span>FAQ</span><span class="sr-only">Leggi le faq relative al plugin</span>
            </button></a>
    </div>-->


