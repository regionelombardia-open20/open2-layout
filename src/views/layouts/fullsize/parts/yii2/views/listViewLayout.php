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

use open20\amos\core\controllers\CrudController;

$customSummaryClass = (isset($customSummaryClass)) ? $customSummaryClass : '';
$customListClass = (isset($customListClass)) ? $customListClass : '';
$customPaginationClass = (isset($customPaginationClass)) ? $customPaginationClass : '';
$currentViewClass = ((Yii::$app->controller instanceof CrudController &&
    isset(Yii::$app->controller->currentView['name']) &&
    (Yii::$app->controller->currentView['name'] == 'grid')) ?
    'table_switch' :
    ''
);

?>

<?php if ($showPageSummary) : ?>
    <div class='summary-design d-flex justify-content-between w-100 <?= $customSummaryClass ?>'>
        {summary}
    </div>
<?php endif; ?>
<div class='list-view-design it-list-wrapper <?= $currentViewClass ?> <?= $customListClass ?>'>
    {items}
</div>
<nav aria-label="Pagination" class='pagination-wrapper justify-content-center pagination-design <?= $customPaginationClass ?>'>
    {pager}
</nav>