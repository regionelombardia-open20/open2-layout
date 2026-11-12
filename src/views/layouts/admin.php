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

use yii\helpers\Html;
use yii\helpers\Url;

////\bedezign\yii2\audit\web\JSLoggingAsset::register($this);

/* @var $this \yii\web\View */
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
?>



<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head"); ?>
</head>

<body>

    <?php $this->beginBody() ?>

        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>


    </div>

    <?php if (isset(Yii::$app->params['logo-bordo'])) :  ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <section id="bk-page">
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
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-breadcrumbs"); ?>
                <div class="page-header">
                    <h1 class="title"><?= Html::encode($this->title) ?></h1>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                </div>
                <?= $content ?>
            </div>
        </div>
    </section>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>