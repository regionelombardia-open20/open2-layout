<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\layout
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
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head"); ?>
</head>
<body>

<?php $this->beginBody() ?>
<?= $this->render("parts" . DIRECTORY_SEPARATOR . "skiplink"); ?>

<section id="bk-page">

    <div class="container">

        <div class="page-content">

            <div class="page-header">
                <?php if (!is_null($this->title)): ?>
                    <h1 class="title"><?= \open20\amos\core\helpers\Html::encode($this->title) ?></h1>
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                <?php endif; ?>
            </div>

            <?php if ($this instanceof \open20\amos\core\components\AmosView): ?>
                <?php $this->beginViewContent() ?>
            <?php endif; ?>
            <?= $content ?>
            <?php if ($this instanceof \open20\amos\core\components\AmosView): ?>
                <?php $this->endViewContent() ?>
            <?php endif; ?>
        </div>
    </div>

</section>
<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
