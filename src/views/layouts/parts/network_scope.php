<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\layout\views\layouts\parts
 * @category   CategoryName
 */

$moduleCwh = Yii::$app->getModule('cwh');
$moduleCommunity = Yii::$app->getModule('community');

$scope = null;
if (!empty($moduleCwh)) {
    /** @var \lispa\amos\cwh\AmosCwh $moduleCwh */
    $scope = $moduleCwh->getCwhScope();
}
if (!empty($scope)) {
    if (isset($scope['community'])) {
        $communityId = $scope['community'];
        $community = \lispa\amos\community\models\Community::findOne($communityId);
    }
}
$controller = Yii::$app->controller;
$isActionUpdate = ($controller->action->id == 'update');
$confirm = $isActionUpdate ? [
    'confirm' => \lispa\amos\core\module\BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
] : null;

$model = null;

/*
 * Commentato per non mostrare la fascia relativa alla community anche quando si arriva da un plugin dalla dashboard.
 */
//if ($controller->hasProperty('model')) {
//    $model = $controller->model;
//    if ($model->hasProperty('community_id')) {
//        $communityId = $model->community_id;
//        $community = \lispa\amos\community\models\Community::findOne($communityId);
//    }
//}

if (isset($community)) {

    $viewParams = [
        'community' => $community,
        'model' => $model,
        'confirm' => $confirm
    ];

    //TODO check why without register this js the confirmation dialog on delete action (context menu widget) does not make any confirmation popup.
    \yii\web\YiiAsset::register($this);

    if ($community->context == \lispa\amos\community\models\Community::className()) {
        echo $this->render('community_network_scope', $viewParams);
    } else {
        if (!is_null(Yii::$app->getModule('events')) && $community->context == \lispa\amos\events\models\Event::className()) {
            echo $this->render('events_network_scope', $viewParams);
        }
    }
}
