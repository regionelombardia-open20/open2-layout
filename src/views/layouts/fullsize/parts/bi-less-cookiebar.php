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

\open20\amos\layout\assets\CookieBarAsset::register($this);
?>
<div class="cookiebar">
    <p><?= Module::t('amosdesign','Questo sito utilizza cookie tecnici, analytics e di terze parti. <br>Proseguendo nella navigazione accetti l’utilizzo dei cookie.')?></p>
    <div class="cookiebar-buttons">
        <a href="<?= ($cookiePolicyLink)?: '/it/cookie-policy' ?>" class="cookiebar-btn"><?= Module::t('amosdesign','Informativa<span class="sr-only">cookies</span>')?></a>
        <button data-accept="cookiebar" class="btn btn-primary ml-4 cookiebar-confirm"><?= Module::t('amosdesign','Accetto<span class="sr-only"> i cookies</span>')?></button>
    </div>
</div>