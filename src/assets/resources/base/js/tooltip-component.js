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

$amos.tooltipComponent = (function tooltipComponent () {
    const tooltipModule = {};

    tooltipModule.init = function () {
        watch();
    };

    function watch () {
        window.addEventListener('touchstart', touchListener, {passive: false});
    }

    // Nei dispositivi touch, inibisce il primo tap per permettere l'apertura
    // del toltip al secondo tap, seguirà la normale procedura prevista
    function touchListener(event) { 
        const $target = $(event.target);
        const elements = [
            $target.parents('#toggle-translate'),
            $target.parents('#toggle-assistance')
        ]; 

        for(i in elements) {
            if(event.cancelable && elements[i].length) {
                if(!elements[i].is('a:focus')) {
                    event.preventDefault();
                    event.stopPropagation();
                    elements[i].focus();
                }
                else {
                    elements[i].blur();
                }
            }
        }
    };

    return tooltipModule;
})();

$amos.ready($amos.tooltipComponent.init());