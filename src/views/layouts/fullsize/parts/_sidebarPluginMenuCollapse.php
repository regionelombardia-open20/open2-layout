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
?>


<?php
$currentControllerAction = $currentController."/".$currentAction;
$activeTargetActionArray = [];
$activeTargetControllerArray = [];

if (isset($dinamicSubMenu) && !empty($dinamicSubMenu)) {
    foreach ($dinamicSubMenu as $k => $singleMenu) {
        if(!empty($singleMenu['activeTargetController'])){
            $activeTargetControllerArray[$k] = $singleMenu['activeTargetController']."/".$singleMenu['activeTargetAction'];
        }
        else {
            $activeTargetActionArray[$k] = $singleMenu['activeTargetAction'];
        }
    }
}

$collapseClass = str_replace(' ','', $mainMenu['label']);
?>

<?php if (isset($dinamicSubMenu) && !empty($dinamicSubMenu)) : ?>

    <li class="nav-item <?= ((in_array($currentAction, $activeTargetActionArray) || in_array($currentControllerAction, $activeTargetControllerArray) )? 'active' : '') ?>">
        <div class="plugin">
            <a class="nav-link align-items-center d-flex" data-toggle="collapse" href="#collapseSidebarMenu<?= $collapseClass ?>" title="<?= $mainMenu['titleLink'] ?>" role="button" aria-expanded="false" aria-controls="collapseSidebarMenu<?= $collapseClass ?>">
                <div class="mx-auto text-center">
                    <svg class="icon icon-md icon-white">
                        <use xlink:href="<?= $currentAsset->baseUrl . $mainMenu['icon'] ?>"></use>
                    </svg>
                    <div><?= $mainMenu['label'] ?></div>
                </div>
            </a>
        </div>
        <div class="collapse <?= ((in_array($currentAction, $activeTargetActionArray) || in_array($currentControllerAction, $activeTargetControllerArray))? 'show' : '') ?>" id="collapseSidebarMenu<?= $collapseClass ?>">
            <ul class="nav sub-nav flex-column justify-content-center text-center">
                <?php foreach ($dinamicSubMenu as $singleMenu) : ?>
                <?php
                    if(!empty($singleMenu['activeTargetController'])){
                        $isActive = ($currentControllerAction == $singleMenu['activeTargetController']."/".$singleMenu['activeTargetAction']);
                    }else {
                        $isActive = ($currentAction == $singleMenu['activeTargetAction']);
                    }
                    ?>

                    <li class="nav-item <?= $isActive ? 'active' : '' ?>">
                        <a href="<?= $singleMenu['url'] ?>" title="<?= $singleMenu['titleLink'] ?>"><?= $singleMenu['label'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </li>

<?php else : ?>
    <?php

    if(!empty($mainMenu['activeTargetController'])){
        $isActive = ($currentControllerAction == $mainMenu['activeTargetController']."/".$mainMenu['activeTargetAction']);
    }else {
        $isActive = ($currentAction == $mainMenu['activeTargetAction']);
    }
    ?>

    <li class="nav-item <?= ($isActive ? 'active' : '') ?>">
        <div class="plugin">
            <a class="nav-link align-items-center d-flex" href="<?= $mainMenu['url'] ?>" title="<?= $mainMenu['titleLink'] ?>">
                <div class="mx-auto text-center">
                    <svg class="icon icon-md icon-white">
                        <use xlink:href="<?=  $currentAsset->baseUrl .$mainMenu['icon'] ?>"></use>
                    </svg>
                    <div><?= $mainMenu['label'] ?></div>
                </div>
            </a>
        </div>
    </li>

<?php endif; ?>