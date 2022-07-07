<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core\views\layouts
 * @category   CategoryName
 */

use open20\amos\core\components\AmosView;
use yii\helpers\Url;
use open20\amos\core\widget\WidgetAbstract;
use open20\amos\layout\assets\BiLessAsset;
use app\components\CmsHelper;


//\bedezign\yii2\audit\web\JSLoggingAsset::register($this);
use yii\helpers\Html;


/* @var $this \yii\web\View */
/* @var \open20\amos\core\components\PartQuestionarioAbstract $partsQuestionario */
/* @var $content string */

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

$script = <<< SCRIPT
$(document).ready(function (){

    setTimeout(function (){

        var errori = $('.error-regionale');
        if($(errori).length){
            $(".error-summary-fake").fadeIn();
        }else{
            $(".error-summary-fake").fadeOut();
        }

    }, 500 );

    $('body').on('afterValidate', 'form' , function (){

        setTimeout(function (){
            var errori = $('.error-regionale');
                if($(errori).length){
                    $(".error-summary-fake").fadeIn();
                }else{
                    $(".error-summary-fake").fadeOut();
                }
        },500);

    });

    $('body').on('change', 'input' , function (){

        setTimeout(function (){
            var errori = $('.error-regionale');
                if(!$(errori).length){
                    $(".error-summary-fake").fadeOut();
                }
        },500);


    });

});
SCRIPT;

$this->registerJs($script, \yii\web\View::POS_END, 'my-options');

?>


<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head", [
        'title' => ((Yii::$app->isCmsApplication()) && !empty($this->params['titleSection'])) ? $this->params['titleSection'] : $this->title
    ]); ?>
</head>

<body>

    <?php $this->beginBody() ?>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?> 

    <?php if (Yii::$app->isCmsApplication()) { ?>
        <?php
        $currentAsset = isset($currentAsset) ? $currentAsset : open20\amos\layout\assets\BiLessAsset::register($this);
        ?>
        <?= $this->render(
            "parts" . DIRECTORY_SEPARATOR . "bi-less-layout-header",
            [
                'currentAsset' => $currentAsset,
            ]
        ); ?>
        <!--< ?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>-->
    <?php } else { ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>

    <?php } ?>

    <?php if (isset(Yii::$app->params['logo-bordo'])) : ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <section id="bk-page" class="fullsizeWizardLayout" role="main">
        <div class="container-messages">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>
            </div>
        </div>

        <div class="container-help">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>
            </div>
        </div>

        <div class="container">
            <div class="page-content">
                <?php if (!isset($this->params['hideBreadcrumb']) || ($this->params['hideBreadcrumb'] === false)) : ?>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "breadcrumb"); ?>
                <?php endif; ?>
                <div class="page-header">
                    <?php if (!isset($this->params['hideWizardTitle']) || ($this->params['hideWizardTitle'] === false)) : ?>
                        <h1 class="title"><?= Html::encode($this->title) ?></h1>
                    <?php endif; ?>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                </div>
                <div class="progress-menu-container">
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "progress_wizard_menu", [
                        'model' => $this->params['model'],
                        'partsQuestionario' => $this->params['partsQuestionario'],
                        'hidePartsLabel' => (isset($this->params['hidePartsLabel']) ? $this->params['hidePartsLabel'] : false),
                        'hidePartsUrl' => (isset($this->params['hidePartsUrl']) ? $this->params['hidePartsUrl'] : false)
                    ]);
                    ?>
                </div>
                <div>
                    <div class="error-summary-fake" style="display: none;">
                        <?php
                        \yii\bootstrap\Alert::begin([
                            'closeButton' => false,
                            'options' => [
                                'class' => 'danger alert-danger error-summary',
                            ],
                        ]);
                        \yii\bootstrap\Alert::end();
                        ?>
                    </div>
                </div>

                <?= $content ?>

            </div>
        </div>
    </section>

    <?php if (Yii::$app->isCmsApplication()) { ?>
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
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>
    <?php } ?>

    <?php /* echo $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); */ ?>




    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>