<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core
 * @category   CategoryName
 */
use open20\amos\layout\assets\FormAsset;
use open20\amos\layout\assets\IEAssets;
use yii\helpers\Html;
use yii\helpers\Url;
use open20\amos\core\widget\WidgetAbstract;
use app\components\CmsHelper;

//\bedezign\yii2\audit\web\JSLoggingAsset::register($this);
/* @var $this \yii\web\View */
/* @var $content string */


$urlCorrente   = Url::current();
$arrayUrl      = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso      = '';
$i             = 0;
$moduloId      = Yii::$app->controller->module->id;
$basePath      = Yii::$app->getBasePath();
if ($moduloId != 'app-backend' && $moduloId != 'app-frontend') {
    $basePath = \Yii::$app->getModule($moduloId)->getBasePath();
    $percorso .= '/modules/'.$moduloId.'/views/'.$arrayUrl[$countArrayUrl - 2];
} else {
    $percorso .= 'views';
    while ($i < ($countArrayUrl - 1)) {
        $percorso .= $arrayUrl[$i].'/';
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
    if (file_exists($basePath.'/'.$percorso.'/help/'.$vista.'.php')) {
        $this->params['help'] = [
            'filename' => $vista
        ];
    }
}
$showSidebarForm = (isset($this->params['showSidebarForm'])) ? $this->params['showSidebarForm'] : false;

FormAsset::register($this);
IEAssets::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

    <head>
        <?=
        $this->render("parts".DIRECTORY_SEPARATOR."head",
            [
            'title' => ((Yii::$app->get('menu', false)) && !empty($this->params['titleSection'])) ? $this->params['titleSection']
                    : $this->title
        ]);
        ?>
    </head>

    <body>
        <!-- add for fix error message Parametri mancanti -->
        <input type="hidden" id="saveDashboardUrl" value="<?= Yii::$app->urlManager->createUrl(['dashboard/manager/save-dashboard-order']); ?>" />
        <?php $this->beginBody() ?>

        <?php if (Yii::$app->get('menu', false)) { ?>
            <?php
            $iconSubmenu = '<span class="am am-chevron-right am-4"> </span>';

            $mainMenu      = (isset(\Yii::$app->params['menuCmsConfigurations']['mainCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['mainCmsMenu']
                    : 'default';
            $secondaryMenu = (isset(\Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['secondaryCmsMenu']
                    : 'secondary';
            $footerMenu    = (isset(\Yii::$app->params['menuCmsConfigurations']['footerCmsMenu'])) ? \Yii::$app->params['menuCmsConfigurations']['footerCmsMenu']
                    : 'footer';

            $cmsDefaultMenuCustomClass   = 'cms-menu-container-default';
            $cmsSecondaryMenuCustomClass = 'cms-menu-container-secondary';
            $cmsFooterMenuCustomClass    = 'cms-menu-container-footer';
            $cmsPluginMenuCustomClass    = 'cms-menu-container-plugin';

            $cmsDefaultMenu = CmsHelper::BiHamburgerMenuRender(
                    Yii::$app->menu->findAll([
                        'depth' => 1,
                        'container' => $mainMenu
                    ]), $iconSubmenu, false, $currentAsset
            );

            $cmsDefaultMenuFooter = CmsHelper::BiHamburgerMenuRender(
                    Yii::$app->menu->findAll([
                        'depth' => 1,
                        'container' => $mainMenu
                    ]), $iconSubmenu, true, $currentAsset
            );

            $cmsFooterMenu = CmsHelper::BiHamburgerMenuRender(
                    Yii::$app->menu->findAll([
                        'depth' => 1,
                        'container' => $footerMenu
                    ]), $iconSubmenu, true
            );

            if (!\Yii::$app->params['layoutConfigurations']['hideCmsMenuPluginHeader']) {
                $cmsPluginMenu = open20\amos\core\module\AmosModule::getModulesFrontEndMenus();
            }

            if (\Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader']) {
                $cmsSecondaryMenu = CmsHelper::BiHamburgerMenuRender(
                        Yii::$app->menu->findAll([
                            'depth' => 1,
                            'container' => $secondaryMenu
                        ]), $iconSubmenu, false
                );
            }

            $cmsDefaultMenu   = Html::tag('ul', $cmsDefaultMenu,
                    ['class' => 'navbar-nav'.' '.$cmsDefaultMenuCustomClass]);
            $cmsSecondaryMenu = Html::tag('ul', $cmsSecondaryMenu,
                    ['class' => 'navbar-nav'.' '.$cmsSecondaryMenuCustomClass]);

            $cmsDefaultMenuFooter = Html::tag('ul', $cmsDefaultMenuFooter,
                    ['class' => 'footer-list link-list'.' '.$cmsDefaultMenuCustomClass]);
            $cmsFooterMenu        = Html::tag('ul', $cmsFooterMenu,
                    ['class' => 'footer-list link-list'.' '.$cmsFooterMenuCustomClass]);
            $cmsFooterMenu        = $cmsDefaultMenuFooter.$cmsFooterMenu;

            $cmsPluginMenu = Html::tag('ul', $cmsPluginMenu, ['class' => 'navbar-nav'.' '.$cmsPluginMenuCustomClass]);
            ?>
            <?php
            $currentAsset  = isset($currentAsset) ? $currentAsset : open20\amos\layout\assets\BiLessAsset::register($this);
            ?>
            <?=
            $this->render("parts".DIRECTORY_SEPARATOR."bi-less-header",
                [
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
                'userProfileLinkCommon' => \Yii::$app->params['linkConfigurations']['userProfileLinkCommon'],
                'customUserMenuLogoutLink' => \Yii::$app->params['linkConfigurations']['logoutLinkCommon'],
                'showSocial' => \Yii::$app->params['layoutConfigurations']['showSocialHeader'],
                'showSecondaryMenu' => \Yii::$app->params['layoutConfigurations']['showSecondaryMenuHeader'],
                'disableThemeLight' => \Yii::$app->params['layoutConfigurations']['disableThemeLightHeader'],
                'disableSmallHeader' => \Yii::$app->params['layoutConfigurations']['disableSmallHeader'],
                'enableHeaderSticky' => \Yii::$app->params['layoutConfigurations']['enableHeaderStickyHeader'],
                'frontendUrl' => \Yii::$app->params['platform']['frontendUrl'],
                'pageSearchLink' => \Yii::$app->params['linkConfigurations']['pageSearchLinkCommon'],
            ]);
            ?>
            <!--< ?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>-->
        <?php } else { ?>
            <div id="headerFixed">
                <?= $this->render("parts".DIRECTORY_SEPARATOR."header"); ?>
                <?= $this->render("parts".DIRECTORY_SEPARATOR."logo"); ?>
            </div>
        <?php } ?>

        <?php if (isset(Yii::$app->params['logo-bordo'])) : /* && \Yii::$app->params['logo-bordo'] == TRUE) */ ?>
            <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
        <?php endif; ?>

        <section id="bk-page" class="fullsizeFormLayout">

            <?php
            if (
                !empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS
                && (!isset(\Yii::$app->params['disable_network_scope']) || \Yii::$app->params['disable_network_scope'] == false)
            ) :
                ?>
                <?= $this->render("parts".DIRECTORY_SEPARATOR."network_scope"); ?>
            <?php endif; ?>

            <?= $this->render("parts".DIRECTORY_SEPARATOR."messages"); ?>

            <?= $this->render("parts".DIRECTORY_SEPARATOR."help"); ?>

            <div id="record_form" class="container">

                <?php if (empty(\Yii::$app->params['dashboardEngine'])) : ?>
                    <?= $this->render("parts".DIRECTORY_SEPARATOR."network_scope"); ?>
                <?php endif; ?>

                <div class="page-content">
                    <div class="layout-sidebarForm">
                        <?php
                        if ($showSidebarForm) {
                            echo $this->render("parts".DIRECTORY_SEPARATOR."bi-less-sidebarForm", ['viewParams' => \Yii::$app->getView()->params['bi-menu-sidebar']]);
                        }
                        ?>

                        <div class="<?= ($showSidebarForm) ? 'main-with-sidebar' : '' ?>">
                            <?php if ($showSidebarForm) { ?>
                                <a class="btn-sidebar btn-lg" role="button" title="Visualizza sidebar" data-toggle="collapse" href="#sidebarForm" aria-expanded="false" aria-controls="sidebarForm">
                                    <span class="mdi mdi-24px mdi-apps mdi-flip-h"></span>
                                </a>
                            <?php } ?>
                            <?= $this->render("parts".DIRECTORY_SEPARATOR."bi-breadcrumbs"); ?>

                            <div class="page-header">
                                <?php if (!is_null($this->title)) : ?>
                                    <h1 class="title"><?= Html::encode($this->title) ?></h1>
                                    <?= $this->render("parts".DIRECTORY_SEPARATOR."textHelp"); ?>
                                <?php endif; ?>
                            </div>

                            <?= $content ?>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <?= $this->render("parts".DIRECTORY_SEPARATOR."sponsors"); ?>

        <?php if (Yii::$app->get('menu', false)) { ?>
            <?php
            $iconSubmenu   = '<span class="am am-chevron-right am-4"> </span>';
            $cmsFooterMenu = app\components\CmsHelper::BiHamburgerMenuRender(
                    Yii::$app->menu->findAll([
                        'depth' => 1,
                        'container' => 'footer'
                    ]), $iconSubmenu, 'cms-menu-container-footer', true
            );
            if ((isset(\Yii::$app->params['layoutConfigurations']['customPlatformFooter']))) :

                $customPlatformFooter = \Yii::$app->params['layoutConfigurations']['customPlatformFooter'];
                echo $this->render($customPlatformFooter,
                    [
                    'currentAsset' => $currentAsset,
                    'cmsFooterMenu' => $cmsFooterMenu
                ]);

            endif;
            ?>
        <?php } else { ?>
            <?= $this->render("parts".DIRECTORY_SEPARATOR."footer_text"); ?>
        <?php } ?>

        <?php /* echo $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); */ ?>

        <?php $this->endBody() ?>

    </body>

</html>
<?php $this->endPage() ?>