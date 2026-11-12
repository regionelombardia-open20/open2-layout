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

// krajee-dialog configuration for all data-confirm link
var krajeeModalOptions = {
    "cssClass": "krajee-amos-modal"
}
var krajeeDefaultValues = {
    "alert": {
        "type": "type-info",
        "title": "Informazione",
        "buttonLabel": lajax.t('Conferma')
    },
    "confirm": {
        "type": "type-warning",
        "title": lajax.t('Conferma'),
        "btnOKClass": "btn-warning",
        "btnOKLabel": lajax.t('Conferma'),
        "btnCancelLabel": lajax.t('Annulla'),
    },
    "prompt": {
        "draggable": false,
        "title": "Informazione",
        "buttons": [{"label": lajax.t('Annulla')}, {
            "label": lajax.t('Conferma'),
            // "icon": "glyphicon glyphicon-ok",
            "cssClass": "btn-primary"
        }],
        "closable": false
    },
    "dialog": {
        "draggable": true,
        "title": lajax.t('Informazione'),
        "buttons": [
            {
                "label": lajax.t('Annulla'),
                // "icon": "glyphicon glyphicon-ban-circle"
            },
            {
                "label": lajax.t('Conferma'),
                // "icon": "glyphicon glyphicon-ok",
                "cssClass": "btn-primary"
            }
        ]
    }
};
var krajeeDialog = new KrajeeDialog(true, krajeeModalOptions, krajeeDefaultValues);
krajeeYiiConfirm('krajeeDialog');


/**
 * 
 * Bug: Html a with data-confirm inside a form should not submit a form #17624
 * 
 */
$(document).on('click', 'a[data-url-confirm]', function (e){
    var link                = $(this);
    var address             = link.attr('href');

    krajeeDialog.confirm($(e.currentTarget).data('urlConfirm'),function (result)
                    {
                            if(result){
                                window.location.href = address;
                                return true;
                            }else{
                                return true;
                            }
                    });
	e.preventDefault();
	return false;
    }
);