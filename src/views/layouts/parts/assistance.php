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

use open20\amos\core\icons\AmosIcons;
use yii\helpers\Html;
use open20\amos\core\widget\WidgetAbstract;

//Pickup assistance params
$assistance = isset(\Yii::$app->params['assistance']) ? \Yii::$app->params['assistance'] : [];

// New dashboard case
$newDashboard = !empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS;

//Check if is in email mode
$isMail = ((isset($assistance['type']) && $assistance['type'] == 'email') || (!isset($assistance['type']) && isset(\Yii::$app->params['email-assistenza']))) ? true : false;
$mailAddress = isset($assistance['email']) ? $assistance['email'] : (isset(\Yii::$app->params['email-assistenza']) ? \Yii::$app->params['email-assistenza'] : '');
?>

<?php if ((isset($assistance['enabled']) && $assistance['enabled']) || (!isset($assistance['enabled']) && isset(\Yii::$app->params['email-assistenza']))): ?>
    <div class="assistance">
        <a id="toggle-assistance" class="animated" href="<?= $isMail ? 'mailto:' . $mailAddress : (isset($assistance['url']) ? $assistance['url'] : '') ?>">
    <?php  if($newDashboard): ?>
            <div class="wrapper">
    <?php  endif; ?>        
                <?= AmosIcons::show('email', ['class' => 'tooltip-icon']) ?>
                <span class="tooltip-label"><?= Yii::t('amoscore', 'Hai bisogno di assistenza?'); ?></span>
                <span class="sr-only"><?= Yii::t('amoscore', 'Verrà aperta una nuova finestra') ?></span>
    <?php  if($newDashboard): ?>    
            </div> 
    <?php  endif; ?>
        </a>
    </div>
<?php endif; ?>