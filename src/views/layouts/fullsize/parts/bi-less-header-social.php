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

use open20\amos\core\module\BaseAmosModule;
use yii\helpers\Html;

?>

<?php if (isset(Yii::$app->params['socialConfigurations']) && is_array(Yii::$app->params['socialConfigurations']) && !empty(Yii::$app->params['socialConfigurations'])) : ?>
    <?php
    $socialConfigurations = Yii::$app->params['socialConfigurations'];
    ?>
    <div class="it-socials  flexbox">
        <span class="text-primary follow-text"><?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') ?></span>
        <ul class="social-list list-unstyled flexbox">
            <?php foreach ($socialConfigurations as $k => $socialConf) : ?>
                <?php if ($k == 'twitter-x-brand') : ?>
                    <li>
                    <a href="<?= $socialConf ?>" aria-label="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su X') ?>" target="_blank" title="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su Twitter')?>">

                        <span class="mdi-2 mdi-<?= $k ?> icon"> </span>
                    </a>
                </li>
                <?php else: ?>
                    <?php if ($k == 'telegram') : ?>
                        <li>
                            <a href="<?= $socialConf ?>" aria-label="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>" target="_blank" title="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>">
                                <span class="mdi mdi-send-outline telegram-icon"></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= $socialConf ?>" aria-label="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>" target="_blank" title="<?= \open20\amos\layout\Module::t('amoslayout', 'Seguici su') . ' ' . $k ?>">

                                <span class="mdi mdi-<?= $k ?> icon"> </span>
                            </a>
                        </li>
                    <?php endif; ?>


            
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>