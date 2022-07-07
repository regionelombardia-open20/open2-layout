<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core
 * @category   CategoryName
 */

use open20\amos\core\module\BaseAmosModule;
use yii\helpers\Html;
use open20\amos\core\widget\WidgetAbstract;

/** @var bool|false $disablePlatformLinks - if true all the links to dashboard, settings, etc are disabled */
$disablePlatformLinks = isset(Yii::$app->params['disablePlatformLinks']) ? Yii::$app->params['disablePlatformLinks'] : false;

?>

<div class="it-brand-wrapper d-flex align-items-center">

    <?php if (isset(Yii::$app->params['logoConfigurations']) && is_array(Yii::$app->params['logoConfigurations']) && !empty(Yii::$app->params['logoConfigurations'])) : ?>

        <!-- new logo configurations -->
        <?php
        $logoConfigurations = Yii::$app->params['logoConfigurations'];
        ?>
        <?php foreach ($logoConfigurations as $logoConf) : ?>

            <?php if (!$logoConf['positionTop']) : ?>

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

                <?php if (!isset($logoConf['logoImg']) && !isset($logoConf['logoText']) && !isset($logoConf['logoSignature'])  && !isset($logoConf['logoImgWhite'])) : ?>
                    <?php
                    if (isset($logoConf['logoPosition'])) {
                        $logoOptions['class'] = $logoConf['logoPosition'];
                    }
                    ?>
                    <div class="it-brand-text">
                        <?= (!$disablePlatformLinks) ? Html::a(Yii::$app->name, $logoUrl, $logoOptions) : Html::tag('p', Yii::$app->name); ?>
                    </div>
                <?php endif; ?>

                <!-- image logo -->
                <?php if (isset($logoConf['logoImg'])) : ?>
                    <?php
                    if (!$disablePlatformLinks) {
                        $logoImg = Html::img($logoConf['logoImg'], [
                            // 'class' => 'img-fluid',
                            'alt' => $logoAlt
                        ]);
                        if (isset($logoConf['logoPosition'])) {
                            if (isset($logoOptions['class'])) {
                                $logoOptions['class'] .= ' ' . $logoConf['logoPosition'];
                            } else {
                                $logoOptions['class'] = $logoConf['logoPosition'];
                            }
                        }
                        $logo = Html::a(Html::tag('div', $logoImg, ['class' => 'it-brand-text d-none d-sm-block']), $logoUrl, $logoOptions);
                    } else {
                        $logo = Html::tag('div', Html::img($logoConf['logoImg'], [
                            // 'class' => 'img-fluid' . (isset($logoConf['logoPosition']) ? ' ' . $logoConf['logoPosition'] : ''),
                            'alt' => $logoAlt
                        ]), ['class' => 'it-brand-text d-none d-sm-block']);
                    }
                    ?>
                    <?= $logo; ?>
                <?php endif; ?>

                <!-- text logo -->
                <?php if (isset($logoConf['logoText'])) : ?>
                    <?php
                    $logoTextClass = 'it-brand-text' . (isset($logoConf['logoPosition']) ? ' ' . $logoConf['logoPosition'] : '');
                    ?>
                    <div class="<?= $logoTextClass ?>">
                        <strong class="text-secondary">
                            <?= $logoConf['logoText'] ?>
                        </strong>
                    </div>
                <?php endif; ?>

                <!-- signature logo -->
                <?php if (isset($logoConf['logoSignature'])) : ?>
                    <?php
                    if (!$disablePlatformLinks) {
                        $logoSignature = Html::img($logoConf['logoSignature'], [
                            'class' => 'it-brand-text',
                            'alt' => $logoAlt
                        ]);
                        if (isset($logoConf['logoPosition'])) {
                            if (isset($logoOptions['class'])) {
                                $logoOptions['class'] .= ' ' . $logoConf['logoPosition'];
                            } else {
                                $logoOptions['class'] = $logoConf['logoPosition'];
                            }
                        }
                        $signature = Html::a(Html::tag('div', $logoSignature, ['class' => 'it-brand-text']), $logoUrl, $logoOptions);
                    } else {
                        $signature = Html::tag('div', Html::img($logoConf['logoSignature'], [
                            'class' => 'it-brand-text' . (isset($logoConf['logoPosition']) ? ' ' . $logoConf['logoPosition'] : ''),
                            'alt' => $logoAlt
                        ]), ['class' => 'it-brand-text']);
                    }
                    ?>
                    <?= $signature ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>