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

use open20\amos\core\icons\AmosIcons;
use open20\amos\layout\Module;

$moduleCwh       = Yii::$app->getModule('cwh');
$scope       = null;
$communityId = null;
if (!empty($moduleCwh)) {
    /** @var \open20\amos\cwh\AmosCwh $moduleCwh */
    $scope = $moduleCwh->getCwhScope();
}
if (!empty($scope)) {
    if (isset($scope['community'])) {
        $communityId = $scope['community'];
        //$community   = \open20\amos\community\models\Community::findOne($communityId);
    }
}
?>
<?php
if (empty($communityId)) {
    if ($this->context->action->id !== \Yii::$app->homeUrl) :
?>
        <a class="back-to-dashboard" href="/dashboard" title="<?=
                                                                    Module::t('amoslayout', 'Ritorna alla Dashboard di Piattaforma')
                                                                ?>">
            <?= AmosIcons::show('chevron-left') ?>
            <span><?= Module::t('amoslayout', 'Torna alla Dashboard') ?></span>
        </a>
    <?php endif; ?>

<?php
}
