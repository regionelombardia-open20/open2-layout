<?php

use open20\amos\core\controllers\CrudController;

$customSummaryClass = (isset($customSummaryClass)) ? $customSummaryClass : '';
$customListClass = (isset($customListClass)) ? $customListClass : '';
$customPaginationClass = (isset($customPaginationClass)) ? $customPaginationClass : '';
$currentViewClass = ((Yii::$app->controller instanceof CrudController &&
    isset(Yii::$app->controller->currentView['name']) &&
    (Yii::$app->controller->currentView['name'] == 'grid')) ?
    'table_switch table-responsive' :
    ''
);

?>


<div class='summary-design d-flex justify-content-between w-100 <?= $customSummaryClass ?>'>
    {summary}
</div>
<div class='list-view-design it-list-wrapper <?= $currentViewClass ?> <?= $customListClass ?>'>
    {items}
</div>
<nav class='pagination-wrapper justify-content-center pagination-design <?= $customPaginationClass ?>'>
    {pager}
</nav>

