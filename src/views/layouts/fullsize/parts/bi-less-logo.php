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

use open20\amos\core\module\BaseAmosModule;
use yii\helpers\Html;

?>


<?php if (isset(Yii::$app->params['logoConfigurations']) && is_array(Yii::$app->params['logoConfigurations']) && !empty(Yii::$app->params['logoConfigurations'])) : ?>
    <!-- new logo configurations -->
    <?php
    $logoConfigurations = Yii::$app->params['logoConfigurations'];
    ?>
    <?php foreach ($logoConfigurations as $i => $logoConf) : ?>

        <?php if (!$logoConf['positionTop']) : ?>
            <?php

            //DEFAULT URL
            $logoUrl = Yii::$app->homeUrl;

            //CHECK URL
            if (isset($logoConf['logoUrl'])) {
                if ($logoConf['logoUrl'] == 'frontendUrl') {
                    $logoUrl = Yii::$app->params['platform']['frontendUrl'];
                } elseif ($logoConf['logoUrl'] == 'backendUrl') {
                    $logoUrl = Yii::$app->params['platform']['backendUrl'];
                } else {
                    $logoUrl = $logoConf['logoUrl'];
                }
            }

            //DEFAULT OPTIONS LOGO
            $logoOptions = [];
            $logoAlt = Yii::$app->name;
            $title = '';

            //CHECK TITLE LINK
            $logoOptions['title'] = $title;
            if (isset($logoConf['logoTitle'])) {
                $logoOptions['title'] = (isset($logoConf['logoTranslateCategory']) ? Yii::t($logoConf['logoTranslateCategory'], $logoConf['logoTitle']) : $logoConf['logoTitle']);
            }

            //CHECK TARGET LINK
            if (isset($logoConf['logoUrlTarget'])) {
                $logoOptions['target'] = $logoConf['logoUrlTarget'];
            }

            //CHECK ADDITIONAL CLASS
            if (isset($logoConf['logoClass'])) {
                if (isset($logoOptions['class'])) {
                    $logoOptions['class'] .= ' ' . $logoConf['logoClass'];
                } else {
                    $logoOptions['class'] = $logoConf['logoClass'];
                }
            }

            //CHECK ALT IMAGE
            if (isset($logoConf['logoAlt'])) {
                if (isset($logoConf['logoTranslateCategory'])) {
                    $logoAlt = Yii::t($logoConf['logoTranslateCategory'], $logoConf['logoAlt']);
                } else {
                    $logoAlt = $logoConf['logoAlt'];
                }
            }
            ?>

            <!-- IF IS SET LOGO IMAGE -->
            <?php if (isset($logoConf['logoImg']) && (!empty($logoConf['logoImg']))) : ?>
                <?php

                $logoImg = Html::img($logoConf['logoImg'], ['class' => 'img-responsive', 'alt' => $logoAlt]);
                $logoImgClass = 'it-brand-text' . ' ' . (isset($logoConf['logoClass']) ? ' ' . $logoConf['logoClass'] : 'd-block');

                if (isset($logoConf['logoUrl'])) {
                    $logo = Html::a(Html::tag('div', $logoImg, ['class' => $logoImgClass]), $logoUrl, $logoOptions);
                } else {
                    $logo = Html::tag('div', $logoImg, ['class' => $logoImgClass]);
                }
                ?>
                <?= $logo; ?>

            <!-- IF IS SET LOGO TEXT -->
            <?php elseif (isset($logoConf['logoText'])) : ?>
                <?php
                $logoTextClass = 'it-brand-text' . (isset($logoConf['logoClass']) ? ' ' . $logoConf['logoClass'] : '');
                ?>
                <div class="<?= $logoTextClass ?>">
                    <strong class="text-secondary">
                        <?= (isset($logoConf['logoUrl'])) ? Html::a($logoConf['logoText'],$logoUrl, $logoOptions) : $logoConf['logoText'] ?>
                    </strong>
                </div>
            <?php endif; ?>

            <!-- CHECK NO LOGO FOUND -->
            <?php if (!isset($logoConf['logoImg']) && !isset($logoConf['logoText'])) : ?>
                <div class="it-brand-text">
                    <?= (isset($logoConf['logoUrl'])) ? Html::a(Yii::$app->name, $logoUrl, $logoOptions) : Html::tag('p', Yii::$app->name); ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>      
    <?php endforeach; ?>
<?php endif; ?>