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

/* @var $this \yii\web\View */
/* @var $content string */

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

<div class="login-page col-lg-4 col-md-6 col-sm-6 col-xs-12 col-lg-push-4 col-md-push-3 col-sm-push-3 nop">

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

    <div class="col-xs-12 dropdown-languages">
        <?php
        $headerMenu = new \open20\amos\core\views\common\HeaderMenu();
        $menuLang = $headerMenu->getListLanguages();
        echo $menuLang;
        ?>
    </div>
    <div class="clearfix"></div>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo_login"); ?>

    <?= $content ?>

</div>

<div class="clearfix"></div>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
