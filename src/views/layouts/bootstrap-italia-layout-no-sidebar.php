<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-layout
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

use \open20\amos\layout\assets\BootstrapItaliaCustomAsset;
use open20\amos\core\components\AmosView;

$currentAsset = BootstrapItaliaCustomAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-head", [
        'currentAsset' => $currentAsset
    ]); ?>
</head>

<body class="bg-body">
    <?php $this->beginBody() ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?> 
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-header", [
        'currentAsset' => $currentAsset,
        'disableToggleSidebar' => true
    ]); ?>




    <div id="mainContent" class="container-fluid bootstrap-italia-layout-no-sidebar <?= \Yii::$app->view->params['customClassMainContent'] ?>">
        <div class="row">

            <main role="main" class="py-4 px-lg-5 px-4 w-100 bg-white">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-messages", [
                    'currentAsset' => $currentAsset
                ]); ?>

                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-breadcrumbs", [
                    'currentAsset' => $currentAsset
                ]); ?>

                <?php if ($this instanceof AmosView) : ?>
                    <?php $this->beginViewContent() ?>
                <?php endif; ?>
                <?= $content ?>
                <?php if ($this instanceof AmosView) : ?>
                    <?php $this->endViewContent() ?>
                <?php endif; ?>
            </main>
        </div>



        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer"); ?>

        <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>