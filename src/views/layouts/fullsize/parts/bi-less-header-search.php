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
<div class="it-search-wrapper flexbox">
    <span class="d-none d-md-block text-primary cerca-label"><?= Module::t('amoslayout', 'Cerca') ?></span>
    <a class="search-link rounded-icon " aria-label="<?= Module::t('amoslayout', 'Cerca') ?>" title="<?= Module::t('amoslayout', 'Vai alla pagina di ricerca della piattaforma') . ' ' . \Yii::$app->name ?>" href="<?= $pageSearchLink ?>">
        <svg class="icon" viewBox="0 0 24 24" id="it-search" xmlns="http://www.w3.org/2000/svg">
            <path d="M21.9 21.1L16 15.3a8.3 8.3 0 002-5.3 8 8 0 10-8 8 8.3 8.3 0 005.3-2l5.8 5.9zM10 17a7 7 0 117-7 7 7 0 01-7 7z" />
            <path fill="none" d="M0 0h24v24H0z" />
        </svg>
    </a>
</div>