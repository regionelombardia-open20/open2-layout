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
use open20\amos\core\helpers\Html;
use open20\amos\admin\assets\ModuleAdminAsset;
use app\components\CmsMenu;

ModuleAdminAsset::register(Yii::$app->view);

/** @var $this \open20\amos\core\components\AmosView */
/** @var $content string */
$urlCorrente = Url::current();
$arrayUrl = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso = '';
$i = 0;
$moduloId = Yii::$app->controller->module->id;
$basePath = Yii::$app->getBasePath();
if ($moduloId != 'app-backend' && $moduloId != 'app-frontend') {
    $basePath = \Yii::$app->getModule($moduloId)->getBasePath();
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

if (!empty(\Yii::$app->params['layoutConfigurations']['layoutType']) && \Yii::$app->params['layoutConfigurations']['layoutType'] == 'layout_rl_2023') {
    $iconLogin      = '<span class="icona a piacere"></span>';
    $iconLogout      = '<span class="icona a piacere"></span>';
} else {
    $iconLogin      = '<span class="mdi mdi-key-variant icon-login ml-auto pl-1"></span>';
    $iconLogout      = '<span class="mdi mdi-exit-to-app icon-login ml-auto pl-1"></span>';
}
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?=
    $this->render("parts" . DIRECTORY_SEPARATOR . "head", [
        'title' => ((Yii::$app->isCmsApplication()) && !empty($this->params['titleSection'])) ? $this->params['titleSection'] : $this->title
    ]);
    ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?>

    <?php if (Yii::$app->isCmsApplication()) { ?>
        <?php
        $iconSubmenu = '<span class="am am-chevron-right am-4"> </span>';

        $mainMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'] : 'default';
        $secondaryMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'] : 'secondary';
        $footerMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'] : 'footer';

        $cmsDefaultMenuCustomClass = 'cms-menu-container-default';
        $cmsSecondaryMenuCustomClass = 'cms-menu-container-secondary';
        $cmsFooterMenuCustomClass = 'cms-menu-container-footer';
        $cmsPluginMenuCustomClass = 'cms-menu-container-plugin';

        $menu1 = new CmsMenu();
        $cmsDefaultMenu = $menu1->luyaMenu(
            $mainMenu,
            $iconSubmenu,
            false
        );
        $menu2 = new CmsMenu();
        $cmsDefaultMenuFooter = $menu2->luyaMenu(
            $mainMenu,
            $iconSubmenu,
            true
        );
        $menu3 = new CmsMenu();
        $cmsFooterMenu = $menu3->luyaMenu(
            $footerMenu,
            $iconSubmenu,
            true
        );

        if (!\Yii::$app->params['layoutConfigurations']['hideCmsMenuPluginHeader']) {
            $cmsPluginMenu = open20\amos\core\module\AmosModule::getModulesFrontEndMenus();
        }

        if (\Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader']) {
            $menu4 = new CmsMenu();
            $cmsSecondaryMenu = $menu4->luyaMenu(
                $secondaryMenu,
                $iconSubmenu,
                false
            );
        }

        $cmsDefaultMenu = Html::tag('ul', $cmsDefaultMenu, ['class' => 'navbar-nav' . ' ' . $cmsDefaultMenuCustomClass]);
        $cmsSecondaryMenu = Html::tag('ul', $cmsSecondaryMenu, ['class' => 'navbar-nav' . ' ' . $cmsSecondaryMenuCustomClass]);

        $cmsDefaultMenuFooter = Html::tag('ul', $cmsDefaultMenuFooter, ['class' => 'footer-list link-list' . ' ' . $cmsDefaultMenuCustomClass]);
        $cmsFooterMenu = Html::tag('ul', $cmsFooterMenu, ['class' => 'footer-list link-list' . ' ' . $cmsFooterMenuCustomClass]);
        $cmsFooterMenu = $cmsDefaultMenuFooter . $cmsFooterMenu;

        $cmsPluginMenu = Html::tag('ul', $cmsPluginMenu, ['class' => 'navbar-nav' . ' ' . $cmsPluginMenuCustomClass]);

        if (!(\Yii::$app->params['layoutConfigurations']['hideCmsMenuPluginHeader'])) :
            $cmsDefaultMenu .= $cmsPluginMenu;
        endif;
        ?>
        <?php
        $currentAsset = isset($currentAsset) ? $currentAsset : open20\amos\layout\assets\BiLessAsset::register($this);
        ?>
        <?=
        $this->render("parts" . DIRECTORY_SEPARATOR . "bi-less-header", [
            'iconLogin' => $iconLogin,
            'iconLogout' => $iconLogout,
            'currentAsset' => $currentAsset,
            'cmsDefaultMenu' => $cmsDefaultMenu,
            'cmsSecondaryMenu' => $cmsSecondaryMenu,
            'privacyPolicyLink' => \Yii::$app->params['linkConfigurations']['privacyPolicyLinkCommon'],
            'cookiePolicyLink' => \Yii::$app->params['linkConfigurations']['cookiePolicyLinkCommon'],
            'hideHamburgerMenu' => \Yii::$app->params['layoutConfigurations']['hideHamburgerMenuHeader'],
            'alwaysHamburgerMenu' => \Yii::$app->params['layoutConfigurations']['showAlwaysHamburgerMenuHeader'],
            'hideLangSwitchMenu' => \Yii::$app->params['layoutConfigurations']['hideLangSwitchMenuHeader'],
            'hideGlobalSearch' => \Yii::$app->params['layoutConfigurations']['hideGlobalSearchHeader'],
            'hideUserMenu' => ((\Yii::$app->params['layoutConfigurations']['hideUserMenuHeader']) || (\Yii::$app->view->params['hideUserMenuHeader'])),
            'hideAssistance' => \Yii::$app->params['assistance']['hideAssistanceHeader'],
            'fluidContainerHeader' => ((\Yii::$app->params['layoutConfigurations']['fluidContainerHeader']) || (\Yii::$app->view->params['fluidContainerHeader'])),
            'customUserMenu' => \Yii::$app->params['layoutConfigurations']['customUserMenuHeader'],
            'customUserNotLogged' => \Yii::$app->params['layoutConfigurations']['customUserNotLoggedHeader'],
            'customUserMenuLoginLink' => \Yii::$app->params['linkConfigurations']['loginLinkCommon'],
            'customUserProfileLink' => \Yii::$app->params['linkConfigurations']['userProfileLinkCommon'],
            'customUserMenuLogoutLink' => \Yii::$app->params['linkConfigurations']['logoutLinkCommon'],
            'showSocial' => \Yii::$app->params['layoutConfigurations']['showSocialHeader'],
            'showSecondaryMenu' => \Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader'],
            'disableThemeLight' => \Yii::$app->params['layoutConfigurations']['disableThemeLightHeader'],
            'disableSmallHeader' => \Yii::$app->params['layoutConfigurations']['disableSmallHeader'],
            'enableHeaderSticky' => \Yii::$app->params['layoutConfigurations']['enableHeaderStickyHeader'],
            'pageSearchLink' => \Yii::$app->params['linkConfigurations']['pageSearchLinkCommon'],
        ]);
        ?>
    <?php } ?>

    <section id="bk-page" class="fullsizeRegistrationBiLayout" role="main">

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>

        <div class="container <?= (!empty($this->params['containerFullWidth']) && $this->params['containerFullWidth'] == true) ? 'container-full-width' : '' ?>">

            <div class="page-content">

                <?php if ($this instanceof AmosView) : ?>
                    <?php $this->beginViewContent() ?>
                <?php endif; ?>
                <?= $content ?>
                <?php if ($this instanceof AmosView) : ?>
                    <?php $this->endViewContent() ?>
                <?php endif; ?>
            </div>
        </div>

    </section>


    <?php if (Yii::$app->isCmsApplication()) { ?>
        <?php
        $iconSubmenu = '<span class="am am-chevron-right am-4"> </span>';
        $menu5 = new CmsMenu();
        $cmsFooterMenu = $menu5->luyaMenu(
            'footer',
            $iconSubmenu,
            true,
            $currentAsset
        );

        if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformFooter']))) :

            $customPlatformFooter = \Yii::$app->params['layoutConfigurations']['customPlatformFooter'];
            echo $this->render($customPlatformFooter, [
                'currentAsset' => $currentAsset,
                'cmsFooterMenu' => $cmsFooterMenu
            ]);

        endif;
        ?>
    <?php } ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>