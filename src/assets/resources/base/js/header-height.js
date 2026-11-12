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

// MARGIN TOP bkPage
function calcMainContentMarginTop() {
  var headerHeight = $('#headerContent').outerHeight();
  var footerHeight = $('#footerContent').outerHeight();
  var viewportHeight = window.innerHeight;
  var spaceFromHeaderToMainContent = '0';
  $('#bk-page').css('margin-top', Number(headerHeight) + Number(spaceFromHeaderToMainContent));
  $('#bk-page').css('min-height', Number(viewportHeight) - (Number(headerHeight) + Number(footerHeight)));
  $('.container-favourites').css('top', Number(headerHeight) + Number('15'));

};

$(document).ready(function () {
  calcMainContentMarginTop();
});

$(window).on('resize',function () {
  calcMainContentMarginTop();
});