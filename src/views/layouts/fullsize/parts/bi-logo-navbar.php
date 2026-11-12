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
use open20\amos\core\widget\WidgetAbstract;

/** @var bool|false $disablePlatformLinks - if true all the links to dashboard, settings, etc are disabled */
$disablePlatformLinks = isset(Yii::$app->params['disablePlatformLinks']) ? Yii::$app->params['disablePlatformLinks'] : false;
?>

<?php if (isset(Yii::$app->params['logoConfigurations']) && is_array(Yii::$app->params['logoConfigurations']) && !empty(Yii::$app->params['logoConfigurations'])) : ?>

    <!-- new logo configurations -->
    <?php
    $logoConfigurations = Yii::$app->params['logoConfigurations'];
    ?>
    <?php foreach ($logoConfigurations as $i => $logoConf) : ?>     
        <?php
        $logoUrl = (!empty(Yii::$app->params['disablePlatformLinks']) ? null : Yii::$app->homeUrl);
        if (isset($logoConf['logoUrl'])) {
            if ($logoConf['logoUrl'] == 'frontendUrl') {
                $logoUrl = Yii::$app->params['platform']['frontendUrl'];
            } elseif ($logoConf['logoUrl'] == 'backendUrl') {
                $logoUrl = Yii::$app->params['platform']['backendUrl'];
            } else {
                $logoUrl = $logoConf['logoUrl'];
            }
        }
        $logoOptions = [];
        $title = BaseAmosModule::t('amoscore', 'vai alla dashboard');
        $logoOptions['title'] = $title;
        if (isset($logoConf['logoTitle'])) {
            $logoOptions['title'] = (isset($logoConf['logoTranslateCategory']) ? Yii::t($logoConf['logoTranslateCategory'], $logoConf['logoTitle']) : $logoConf['logoTitle']);
        }
        if (isset($logoConf['logoUrlTarget'])) {
            $logoOptions['target'] = $logoConf['logoUrlTarget'];
        }
        $logoAlt = Yii::$app->name;
        if (isset($logoConf['logoAlt'])) {
            if (isset($logoConf['logoTranslateCategory'])) {
                $logoAlt = Yii::t($logoConf['logoTranslateCategory'], $logoConf['logoAlt']);
            } else {
                $logoAlt = $logoConf['logoAlt'];
            }
        }
        ?>

        <?php if (!isset($logoConf['logoImg']) && !isset($logoConf['logoImgWhite']) && !isset($logoConf['logoText']) && !isset($logoConf['logoSignature'])) : ?>
            <?php
            if (isset($logoConf['logoPosition'])) {
                $logoOptions['class'] = $logoConf['logoPosition'];
            }
            ?>
            <div class="it-brand-text">
                <?= (!$disablePlatformLinks) ? Html::a(Yii::$app->name, $logoUrl, $logoOptions) : Html::tag('p', Yii::$app->name); ?>
            </div>
        <?php endif; ?>

        <!-- image logo white-->
        <?php if (isset($logoConf['logoImgWhite'])) : ?>
            <?php
            if (!$disablePlatformLinks) {
                $logoImgWhite = Html::img($logoConf['logoImgWhite'], [
                            'class' => 'd-sm-none',
                            'alt' => $logoAlt
                ]);
                if (isset($logoConf['logoPosition'])) {
                    if (isset($logoOptions['class'])) {
                        $logoOptions['class'] .= ' ' . $logoConf['logoPosition'];
                    } else {
                        $logoOptions['class'] = $logoConf['logoPosition'];
                    }
                }
                $logo = Html::a($logoImgWhite, $logoUrl, $logoOptions);
            } else {
                $logo = Html::tag('div', Html::img($logoConf['logoImgWhite'], [
                                    'alt' => $logoAlt
                                ]), ['class' => '']);
            }
            ?>
            <?= $logo; ?>
        <?php endif; ?>     
    <?php endforeach; ?>
<?php endif; ?>