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
use yii\helpers\Html;


$currentAsset = BootstrapItaliaCustomAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-head"); ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-skiplink"); ?> 
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-header", [
        'currentAsset' => $currentAsset
    ]); ?>




    <div id="mainContent" class="container-fluid bootstrap-italia-layout-with-sidebar <?= \Yii::$app->view->params['customClassMainContent'] ?>">
        <div class="row">

            <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-sidebarLeft", [
                'currentAsset' => $currentAsset
            ]); ?>

            <main role="main" class="py-4 px-lg-5 px-4 w-100">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-messages", [
                    'currentAsset' => $currentAsset
                ]); ?>

                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-content-header", [
                    'currentAsset' => $currentAsset,
                    'titleContent' => $this->title
                ]); ?>

                <?php if ($this instanceof AmosView) : ?>
                    <?php $this->beginViewContent() ?>
                <?php endif; ?>
                <div class="d-flex justify-content-between">
                
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-search", [
                    'currentAsset' => $currentAsset
                ]); ?>

                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "bi-change-view", [
                    'currentAsset' => $currentAsset
                ]); ?>
                </div>
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