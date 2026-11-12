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

use open20\amos\layout\Module;
?>

<div class="bi-guide z-index-1031">
  <a class="d-flex align-items-center justify-content-center border border-primary" data-toggle="modal" data-toggle-second="tooltip" title="<?= Module::t('amoslayout', 'Apri la guida della piattaforma {platformName}', ['platformName' => \Yii::$app->name]) ?>" data-target="#helpGuideModalAmosLayout">
    <span class="mdi mdi-lifebuoy"></span>
    <span class="sr-only"><?= Module::t('amoslayout', 'Apri la guida della piattaforma {platformName}', ['platformName' => \Yii::$app->name]) ?></span>
  </a>
</div>

<div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="helpGuideModalAmosLayout">
  <div class="modal-dialog modal-dialog-right modal-xl" role="document">
    <div class="modal-content text-left">
      <div class="modal-header shadow-sm">
        <h2 class="h3 modal-title"><?= Module::t('amoslayout', 'Guida {platformName}', ['platformName' => \Yii::$app->name]) ?></h2>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span class="mdi mdi-close"></span>
        </button>
      </div>
      <div class="modal-body pt-3">
        <div id="helpGuidaGoTopAmosLayout" class="d-none"></div>
        <?= $this->render($pathView) ?>
      </div>
    </div>
    <div class="modal-footer justify-content-start border-top">
      <a href="javascript:void(0)" data-jsanchortarget="#helpGuidaGoTopAmosLayout"><?= Module::t('amoslayout', 'Torna su') ?></a>
    </div>
  </div>
</div>