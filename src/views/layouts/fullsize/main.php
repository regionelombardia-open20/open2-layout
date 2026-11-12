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

use open20\amos\core\components\AmosView;
use yii\helpers\Url;
use open20\amos\core\widget\WidgetAbstract;
use open20\amos\layout\assets\BiLessAsset;
use app\components\CmsHelper;
use open20\amos\core\helpers\Html;


/** @var $this \open20\amos\core\components\AmosView */
/** @var $content string */

$configLayoutCommunity = \open20\amos\layout\utility\LayoutUtility::isEnabledNewCommunityScope();
$classContainer = $configLayoutCommunity['classContainer'];
$newCommunityLayout = $configLayoutCommunity['newCommunityLayout'];
$isLayoutInScope = $configLayoutCommunity['isLayoutInScope'];

$breadcrumbsClassContainer = '';
if (isset($this->params['breadcrumbsClassContainer'])) {
    if (!empty($classContainer)) {
        $breadcrumbsClassContainer .= ' ';
    }
    $breadcrumbsClassContainer .= $this->params['breadcrumbsClassContainer'];
}


$urlCorrente = Url::current();
$arrayUrl = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso = '';
$i = 0;
$moduloId = Yii::$app->controller->module->id;
$basePath = Yii::$app->getBasePath();
if ($moduloId != 'app-backend' && $moduloId != 'app-frontend') {
    $module = Yii::$app->getModule($moduloId);
    if (!empty($module) && method_exists($module, 'getBasePath')) {
        $basePath = Yii::$app->getModule($moduloId)->getBasePath();
    }
    $percorso .= '/modules/' . $moduloId . '/views/' . $arrayUrl[$countArrayUrl - 2];
} else {
    $percorso .= 'views';
    while ($i < ($countArrayUrl - 1)) {
        $percorso .= $arrayUrl[$i] . '/';
        $i++;
    }
}
if ($countArrayUrl) {
    $posizioneEsclusione = strpos($arrayUrl[$countArrayUrl - 1], '?');
    if ($posizioneEsclusione > 0) {
        $vista = substr($arrayUrl[$countArrayUrl - 1], 0, $posizioneEsclusione);
    } else {
        $vista = $arrayUrl[$countArrayUrl - 1];
    }
    if (file_exists($basePath . '/' . $percorso . '/help/' . $vista . '.php')) {
        $this->params['help'] = [
            'filename' => $vista
        ];
    }
}
?>

<?php $isLuyaApplication = \Yii::$app instanceof luya\web\Application; ?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head", [
        'title' => (($isLuyaApplication && Yii::$app->isCmsApplication()) && !empty($this->params['titleSection'])) ? $this->params['titleSection'] : $this->title
    ]); ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?>

    <?php if ($isLuyaApplication && Yii::$app->isCmsApplication()) { ?>
        <?php
        $currentAsset = isset($currentAsset) ? $currentAsset : open20\amos\layout\assets\BiLessAsset::register($this);
        ?>
        <?= $this->render(
            "parts" . DIRECTORY_SEPARATOR . "bi-less-layout-header",
            [
                'currentAsset' => $currentAsset,
            ]
        ); ?>
    <?php } else { ?>
        <div id="headerFixed">
            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>
        </div>
    <?php } ?>

    <?php if (isset(Yii::$app->params['logo-bordo'])) : ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <?php
    if (class_exists('\open20\design\utility\DesignUtility') && method_exists('\open20\design\utility\DesignUtility', 'showSidebarRedattore')) {
        list($showSidebarRedattore, $openSidebarRedattoreOnLoadPage) = \open20\design\utility\DesignUtility::showSidebarRedattore($this);
    } else {
        if (isset(\Yii::$app->view->params['showSidebarRedattore']) && !\Yii::$app->user->isGuest) {
            $showSidebarRedattore = (\Yii::$app->view->params['showSidebarRedattore']);
        } else {
            if (isset(\Yii::$app->params['layoutConfigurations']['showSidebarRedattore']) && !\Yii::$app->user->isGuest) {
                $showSidebarRedattore = (\Yii::$app->params['layoutConfigurations']['showSidebarRedattore']);
            } else {
                $showSidebarRedattore = false;
            }
        }
    }
    ?>

    <section id="bk-page" class="fullsizeMainLayout <?= ($showSidebarRedattore) ? 'main-with-sidebar-redattore' : 'main-with-sidebar-redattore' ?>" role="main">
        <?php if ($showSidebarRedattore) : ?>
            <?= $this->render("@vendor/open20/design/src/views/layouts/parts/bi-sidebar-redattore", [
                'currentAsset' => $currentAsset
            ]); ?>
        <?php endif ?>
        <div class="main-content w-100">

            <?php
            $classContainerBase = 'container';
            $classContainerBase = (!empty($this->params['containerFluid'])  && $this->params['containerFluid'] == true) ? 'container-fluid' : 'container';
            $classContainerFinal = (!empty($this->params['containerFullWidth']) && $this->params['containerFullWidth'] == true) || $isLayoutInScope ? 'container-full-width' : $classContainerBase;
            ?>
            <div class="<?= $classContainerFinal ?>">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>
            <div class=" <?= ((!empty($this->params['containerFullWidth']) && $this->params['containerFullWidth']
                                == true) || $newCommunityLayout) ? 'container-full-width' : 'container'
                            ?>">
                <div class="page-content">

                    <div class="<?= $classContainer . $breadcrumbsClassContainer ?>">
                        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-breadcrumbs"); ?>
                    </div>

                    <?php if ((!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS)
                        && (!isset(\Yii::$app->params['disable_network_scope']) || \Yii::$app->params['disable_network_scope'] == false)
                    ) : ?>

                        <?php
                        $isLayoutInScope = false;
                        $moduleCwh = \Yii::$app->getModule('cwh');
                        if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
                            $scope = $moduleCwh->getCwhScope();
                            $isLayoutInScope = (!empty($scope)) ? true : false;
                        }
                        ?>

                        <?php if ($newCommunityLayout) { ?>
                            <div class="scope-in-main">
                            <?php } ?>
                            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "network_scope", ['isLayoutInScope' => $isLayoutInScope]); ?>
                            <?php if ($newCommunityLayout) { ?>
                            </div>
                        <?php } ?>
                    <?php endif; ?>

                    <div class="<?= $classContainer ?>">
                        <div class="page-header">
                            <?php if (!is_null($this->title)) : ?>
                                <h1 class="title"><?= \Yii::$app->formatter->asHtml($this->title) ?></h1>
                                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                            <?php endif; ?>
                        </div>
                        <?php if ($this instanceof AmosView) : ?>
                            <?php $this->beginViewContent() ?>
                        <?php endif; ?>
                        <?= $content ?>
                        <?php if ($this instanceof AmosView) : ?>
                            <?php $this->endViewContent() ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($isLuyaApplication && Yii::$app->isCmsApplication()) { ?>
        <?= $this->render(
            "parts" . DIRECTORY_SEPARATOR . "bi-less-layout-footer",
            [
                'currentAsset' => $currentAsset,
            ]
        ); ?>
        <?php
        if (isset(\Yii::$app->view->params['hideCookieBar'])) {
            $hideCookieBarCheck = (\Yii::$app->view->params['hideCookieBar']);
        } else {
            if (isset(\Yii::$app->params['layoutConfigurations']['hideCookieBar'])) {
                $hideCookieBarCheck = (\Yii::$app->params['layoutConfigurations']['hideCookieBar']);
            } else {
                $hideCookieBarCheck = false;
            }
        }
        ?>
        <?php if (!$hideCookieBarCheck) : ?>
            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-less-cookiebar", [
                'currentAsset' => $currentAsset,
                'cookiePolicyLink' => \Yii::$app->params['linkConfigurations']['cookiePolicyLinkCommon']
            ]); ?>
        <?php endif ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-backtotop-button"); ?>
    <?php } else { ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>
    <?php } ?>

    <?php /* echo $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); */ ?>




    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>