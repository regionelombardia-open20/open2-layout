<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\community
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

/**
 * @var boolean $atLeastOnePermission
 * @var array $buttons
 * @var string $mainDivClasses
 */

use open20\amos\core\icons\AmosIcons;

?>
<?php if ($atLeastOnePermission): ?>
    <div class="manage <?= $mainDivClasses ?>">
        <div class="dropdown">
            <a class="manage-menu btn btn-outline-tertiary" data-toggle="dropdown" href="" aria-expanded="true"
               title="<?= Yii::t('amoscore', 'Menu contestuale') ?>">
               <?= AmosIcons::show('settings', ['class' => 'pull-left']) ?>
                <span class="caret"></span>
                <span class="sr-only"><?= Yii::t('amoscore', 'Menu contestuale') ?></span>
            </a>
            <ul class="dropdown-menu pull-right">
                <?php foreach ($buttons as $button): ?>
                    <li><?= $button ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
