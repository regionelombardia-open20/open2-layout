<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\layout\views\layouts\fullsize\parts
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

use open20\amos\admin\AmosAdmin;
use open20\amos\core\interfaces\OrganizationsModelInterface;
use open20\amos\core\interfaces\OrganizationsModuleInterface;
use open20\amos\core\module\AmosModule;
use open20\amos\core\record\Record;
use open20\amos\events\models\Event;

$moduleCwh = Yii::$app->getModule('cwh');
$moduleCommunity = Yii::$app->getModule('community');
$eventsModule = Yii::$app->getModule('events');
$layoutModule = Yii::$app->getModule('layout');
$eventsbuilderModule    = Yii::$app->getModule('eventsbuilder');

$currentAction = \Yii::$app->controller->module->id . '/' . \Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id;
$hideScopeInAction = !empty(\Yii::$app->params['hideScopeinAction']) ? \Yii::$app->params['hideScopeinAction'] : [];
$hideNetworkScope = !empty(\Yii::$app->params['hideNetworkScope']) && \Yii::$app->params['hideNetworkScope'] ? true : false;

$scope = null;
if (!empty($moduleCwh)) {
    /** @var \open20\amos\cwh\AmosCwh $moduleCwh */
    $scope = $moduleCwh->getCwhScope();
}
if (!empty($scope)) {
    if (isset($scope['community'])) {
        $communityId = $scope['community'];
        $community = \open20\amos\community\models\Community::findOne($communityId);
    }
}
$controller = Yii::$app->controller;
$isActionUpdate = ($controller->action->id == 'update');
$confirm = $isActionUpdate ? [
    'confirm' => \open20\amos\core\module\BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
] : null;

$model = null;

/*
 * Commentato per non mostrare la fascia relativa alla community anche quando si arriva da un plugin dalla dashboard.
 */
if ($controller->hasProperty('model')) {
    $model = $controller->model;
    if($model->hasProperty('isNewRecord') && !$model->isNewRecord) {
        if ($model->hasProperty('community_id')) {
            $communityId = $model->community_id;
            $community = \open20\amos\community\models\Community::findOne($communityId);
        }
    }
}

/** @var AmosAdmin $adminModule */
$adminModule = AmosAdmin::instance();
/** @var AmosModule|OrganizationsModuleInterface $organizzazioniModule */
$organizzazioniModule = Yii::$app->getModule($adminModule->getOrganizationModuleName());
if (isset($community)) {
    if (!in_array($currentAction, $hideScopeInAction) && !$hideNetworkScope) {
        $viewParams = [
            'community' => $community,
            'model' => $model,
            'confirm' => $confirm
        ];

        //TODO check why without register this js the confirmation dialog on delete action (context menu widget) does not make any confirmation popup.
        \yii\web\YiiAsset::register($this);

        if ($community->context == \open20\amos\community\models\Community::className()) {
            if(property_exists($moduleCommunity, 'enableNewCommunityHeader') && $moduleCommunity->enableNewCommunityHeader){
               echo \open20\amos\community\widgets\CommunityHeaderWidget::widget(['model' => $community]);
           }else{
                $viewScope = 'community_network_scope';
                $viewParams['isLayoutInScope'] = $isLayoutInScope;
                echo $this->render($viewScope, $viewParams);
           }
        } else if (!is_null($organizzazioniModule) && ($community->context == $organizzazioniModule->getOrganizationModelClass())) {
            if($moduleCommunity->enableNewCommunityHeader){
                echo \open20\amos\community\widgets\CommunityHeaderWidget::widget(['model' => $community, 'isOrganizzazioniCommunity' => true]);
            }else {
                $viewScope = 'organizzazioni_network_scope';
                if (!empty($community->parent_id)) {
                    $viewScope = 'organizzazioni_subcommunity_network_scope';
                }

                /** @var Record|OrganizationsModelInterface $organizationModel */
                $organizationModel = Yii::createObject($organizzazioniModule->getOrganizationModelClass());

                /** @var Record|OrganizationsModelInterface $organization */
                $organization = $organizationModel::findOne(['community_id' => $community->id]);

                $viewParams['organizzazioniModule'] = $organizzazioniModule;
                $viewParams['organization'] = (!is_null($organization) ? $organization : null);
                $viewParams['isLayoutInScope'] = $isLayoutInScope;

                echo $this->render($viewScope, $viewParams);
            }
        } else {
            if (!is_null($eventsModule) && ($community->context == $eventsModule->model('Event'))) {
                /** @var Event $eventModel */
                $eventModel = $eventsModule->createModel('Event');
                $event = $eventModel::findOne(['community_id' => $community->id]);
                $viewParams['model'] = $event;
                if ($eventsModule->hasProperty('enableNewWizard') && $eventsModule->enableNewWizard) {
                    if (\Yii::$app->controller->module->id != 'events') {
                        echo $this->render('events_network_scope_wizard', $viewParams);
                    }
                } else {
                    echo $this->render('events_network_scope', $viewParams);
                }
            } else if (!is_null($eventsbuilderModule) && ($community->context == $eventsbuilderModule->model('Event'))) {
                $eventModel = $eventsbuilderModule->createModel('Event');
                $event = $eventModel::findOne(['community_id' => $community->id]);
                $viewParams['model'] = $event;
                echo $this->render('eventsbuilder_network_scope', $viewParams);
            }else if (!is_null(Yii::$app->getModule('challenge')) && $community->context == \amos\challenge\models\ChallengeTeam::className()) {
                $viewScope = 'challenge_network_scope';
                echo $this->render($viewScope, $viewParams);
            } else {
                if (!in_array($community->context, $layoutModule->excludeNetworkView)) {
                    $viewScope = 'community_network_scope';
                    echo $this->render($viewScope, $viewParams);
                }
            }
        }
    }
}
