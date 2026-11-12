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

use yii\helpers\Html;

?>
<?= $this->render("bi-breadcrumbs", [
    'currentAsset' => $currentAsset
]); ?>
<?php if (!is_null($this->title)) : ?>
    <div class="heading border-bottom mb-4 pb-2">
        <div class="d-flex align-items-center flex-wrap">
            <div class="mr-auto my-2">
                <h3 class="mb-0"><?= Html::encode($this->title) ?></h3>
                <?php if (!empty($this->params['subtitle'])) { ?>
                    <?= $this->params['subtitle'] ?>
                <?php } ?>
            </div>
            <?php if ((!empty($this->params['enableLayoutList']) && $this->params['enableLayoutList'] == true)
                || (!empty(\Yii::$app->params['enableLayoutList']) && \Yii::$app->params['enableLayoutList'])) { ?>
                <?= $this->render("bi-additional-button", [
                    'currentAsset' => $currentAsset
                ]); ?>
                <?= $this->render("bi-new-button", [
                    'currentAsset' => $currentAsset
                ]); ?>

            <?php } ?>
        </div>
    </div>
<?php endif; ?>