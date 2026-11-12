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

?>

<?php if (isset(Yii::$app->params['socialConfigurations']) && is_array(Yii::$app->params['socialConfigurations']) && !empty(Yii::$app->params['socialConfigurations'])) : ?>
  <?php
  $socialConfigurations = Yii::$app->params['socialConfigurations'];
  ?>

  <div class="d-flex link-list-wrapper footer-social">
    <ul class="footer-list link-list clearfix">
      <?php foreach ($socialConfigurations as $k => $socialConf) : ?>
        <?php if ($k == 'twitter-x-brand') : ?>
          <li>
          <a href="<?= $socialConf ?>" aria-label="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su X') ?>" target="_blank" title="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su Twitter')?>">

              <span class="mdi-2 mdi-<?= $k ?> icon"> </span>
            </a>
          </li>
        <?php else : ?>
        <li>
          <a href="<?= $socialConf ?>" aria-label="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>" target="_blank" title="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>" class="social-icon">
            <span class="mdi mdi-<?= $k ?>"></span>
          </a>
        </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>

<?php endif; ?>