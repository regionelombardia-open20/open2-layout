<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\layout\views\layouts\fullsize\parts
 * @category   CategoryName
 */

use open20\amos\community\models\CommunityUserMm;
use open20\amos\core\forms\ContextMenuWidget;
use open20\amos\core\forms\CreatedUpdatedWidget;
use open20\amos\core\forms\MapWidget;
use open20\amos\core\helpers\Html;
use open20\amos\core\icons\AmosIcons;
use open20\amos\core\module\BaseAmosModule;
use open20\amos\events\AmosEvents;
use open20\amos\events\models\EventInvitation;
use open20\amos\events\models\EventMembershipType;
use open20\amos\events\utility\EventsUtility;
use open20\amos\layout\assets\BaseAsset;
use open20\amos\layout\Module;

/**
 * @var \open20\amos\events\models\Event $model
 */

$asset = BaseAsset::register($this);

/** @var \open20\amos\cwh\AmosCwh $cwhModule */
$cwhModule = Yii::$app->getModule('cwh');
$issetCwh = !is_null($cwhModule);

/** @var AmosEvents $eventsModule */
$eventsModule = AmosEvents::instance();

/** @var EventInvitation $eventInvitationModel */
$eventInvitationModel = $eventsModule->createModel('EventInvitation');

$showGoToCommunityButton = (
    !$eventsModule->hasProperty('enableCommunitySections') ||
    ($eventsModule->hasProperty('enableCommunitySections') && EventsUtility::showCommunityButtonInView($model, $eventsModule))
);

if (isset($model)) {
    $viewUrl = $model->getFullViewUrl();
    $controller = Yii::$app->controller;
    $isActionUpdate = ($controller->action->id == 'update');
    $confirm = $isActionUpdate ? [
        'confirm' => BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
    ] : null;
    ?>

    <div class="network-container event-network-container fullscreen-network">
        <!-- BEGIN: event data -->
        <?php
        $url = $model->getEventsImageUrl('square_large', true);
        $logo = Html::img($url, [
            'alt' => $model->getAttributeLabel('eventLogo')
        ]);
        ?>
        <div class="network-box" style="background-image: url('<?= $url ?>')">
            <div class="header-event">
                <div class="network-info container-custom-margin">
                    <div class="wrap-head">
                        <div class="poster-event">
                            <div class="event-data">
                                <div>
                                    <p class="event-day">
                                        <span class="event-month">
                                            <?php if ($model->end_date_hour != NULL) : ?>
                                                <?= ((date("d", strtotime($model->begin_date_hour)) != date("d", strtotime($model->end_date_hour)))? Module::t('amoslayout', '#from') : '')?>
                                            <?php endif; ?>
                                        </span>
                                        <?= date("d", strtotime($model->begin_date_hour)) ?>
                                        <span class="event-month"><?= Yii::$app->formatter->asDate($model->begin_date_hour, 'MMM') ?></span>
                                    </p>
                                    <!--                                <p class="event-year">< ?= date("Y", strtotime($model->begin_date_hour)) ?></p>-->
                                    <?php if ($model->end_date_hour != NULL && date("d", strtotime($model->begin_date_hour)) != date("d", strtotime($model->end_date_hour))): ?> 
                                        <p class="event-day">
                                            <span class="event-month">
                                                <?= Module::t('amoslayout', '#to') ?>
                                            </span>
                                            <?= date("d ", strtotime($model->end_date_hour)) ?>
                                            <span class="event-month"><?= Yii::$app->formatter->asDate($model->end_date_hour, 'MMM') ?></span>
                                        </p>
                                    <?php endif; ?>
                                    <!--                                <p class="event-year">< ?= date("Y", strtotime($model->end_date_hour)) ?></p>-->
                                </div>
                                <p class="event-time">
                                    <?= AmosIcons::show('clock-o', ['class' => 'am'], AmosIcons::DASH) ?>
                                    <span class=""><?= ($model->begin_date_hour ? Yii::$app->getFormatter()->asTime($model->begin_date_hour) : '-') ?></span>
                                    <span> | </span>
                                    <span class=""><?= ($model->end_date_hour ? Yii::$app->getFormatter()->asTime($model->end_date_hour) : '-') ?></span>
                                </p>
                            </div>
                            <div class="event-logo">
                                <?= $logo ?>
                            </div>
                            <div class="map-event">
                                <?php
                                $position = ($model->event_address_house_number ? $model->event_address_house_number . ' ' : '');
                                $position .= ($model->event_address ? $model->event_address . ', ' : '');
                                $position .= (!is_null($model->cityLocation) ? $model->cityLocation->nome . ', ' : '');
                                $position .= (!is_null($model->countryLocation) ? $model->countryLocation->nome : '');

                                $module = Yii::$app->getModule(AmosEvents::getModuleName());
                                if ($module->enableGoogleMap) { ?>
                                    <?= MapWidget::Widget(['position' => $position, 'markerTitle' => $model->event_location, 'zoom' => 10]) ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php 
                   if(isset(Yii::$app->params['isPoi']) && (Yii::$app->params['isPoi'] === true) && ($community->id == 2965))
                   {
                       $viewUrl = \Yii::$app->params['platform']['backendUrl']."/community/join?id=2965";
                   }
                ?>
                    <div class="control-event">
                        <?php $modelName = ''; ?>
                        <?php $modelName = Html::a($model->getTitle(), $viewUrl, [
                            'title' => Module::t("amosevents", "View events"),
                            'data' => $confirm
                        ]) ?>

                        <div class="row">
                            <div class="col-xs-12 col-sm-8 control-address">
                                <h2 class="network-name">
                                    <?= $modelName ?>
                                </h2>
                                <div class="pointer"><?= AmosIcons::show('map-marker', ['class' => 'am-2'], AmosIcons::DASH) ?></div>
                                <p class="boxed-data">
                                    <?php
                                    $eventLocation = '-';
                                    if ($model->event_location) {
                                        if ($model->hasMethod('getShortEventLocation')) {
                                            $eventLocation = $model->getShortEventLocation();
                                        } else {
                                            $eventLocation = $model->event_location;
                                        }
                                    }
                                    ?>
                                    <span class="bold"><?= $eventLocation ?></span>
                                </p>
                                <p class="boxed-data">
                                    <span><?= ($model->event_address) ? $model->event_address . ', ' : '-' ?></span>
                                    <span><?= ($model->event_address_house_number) ? $model->event_address_house_number : '-' ?></span>
                                    <span><?= ($model->event_address_cap) ? $model->event_address_cap : '-' ?></span>
                                    <span><?= ($model->cityLocation) ? $model->cityLocation->nome : '-' ?>
                                        <?= ($model->provinceLocation) ? ' (' . $model->provinceLocation->sigla . ')' : '' ?></span>
                                    <span><?= ($model->countryLocation) ? $model->countryLocation->nome : '-' ?></span>
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-4 control-subscribe">
                                <?php if (!empty($model->registration_date_begin)): ?>
                                    <div>
                                        <span><?= $model->getAttributeLabel('registration_date_begin') ?></span>
                                        <span><?= Yii::$app->getFormatter()->asDatetime($model->registration_date_begin, 'humanalwaysdatetime') ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($model->registration_date_end)): ?>
                                    <div>
                                        <span><?= $model->getAttributeLabel('registration_date_end') ?></span>
                                        <span><?= Yii::$app->getFormatter()->asDatetime($model->registration_date_end, 'humanalwaysdatetime') ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($model->registration_limit_date)): ?>
                                    <div>
                                        <span><?= $model->getAttributeLabel('registration_limit_date') ?></span>
                                        <span><?= Yii::$app->getFormatter()->asDate($model->registration_limit_date) ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($model->seats_available)): ?>
                                    <div>
                                        <span><?= $model->getAttributeLabel('seats_available'); ?></span>
                                        <span class="boxed-data"><?= $model->seats_available ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="network-footer">
                        <?php
                        $userInList = 0;
                        $userStatus = '';

                        /** @var CommunityUserMm $userCommunity */

                        //TODO DA RIFARE
                        foreach ($model->communityUserMm as $userCommunity) { // User not yet subscribed to the event
                            if ($userCommunity->user_id == Yii::$app->user->id) {
                                $userInList = 1;
                                $userStatus = $userCommunity->status;
                                break;
                            }
                        }

                        if (!$userInList) {
                            $appController = Yii::$app->controller;
                            if (($appController->id == 'event') && ($appController->action->id == 'view')) {
                                $button['text'] = '';
                                $button['url'] = null;
                                $button['options']['class'] = '';
                            } else {
                                $button['text'] = AmosEvents::t('amoslayout', '#network_scope_view_details');
                                $button['url'] = $viewUrl;
                                $button['options']['class'] = 'btn btn-navigation-primary btn-event-success';
                            }
                            $button['options']['target'] = '_blank';
                            //$button['options']['data']['confirm'] = $confirm;
                            //                            $button['options']['data']['confirm'] = isset($messagge) ? $messagge : AmosEvents::t('amosevents', 'Do you really want to subscribe?');

                        } else {
                            switch ($userStatus) {
                                case CommunityUserMm::STATUS_WAITING_OK_COMMUNITY_MANAGER:
                                    $button['text'] = AmosEvents::t('amosevents', 'Request sent');
                                    $button['options']['class'] .= ' disabled';
                                    $button['options']['class'] = 'btn btn-navigation-primary btn-event-wait';
                                    break;
                                case CommunityUserMm::STATUS_WAITING_OK_USER:
                                    $button['text'] = AmosEvents::t('amosevents', 'Accept invitation');
                                    $button['url'] = ['/community/community/accept-user', 'communityId' => $model->community_id, 'userId' => Yii::$app->user->id];
                                    $button['options']['data']['confirm'] = isset($messagge) ? $messagge : AmosEvents::t('amosevents', 'Do you really want to accept invitation?');
                                    $button['options']['class'] = 'btn btn-navigation-primary btn-event-wait';
                                    break;
                                case CommunityUserMm::STATUS_ACTIVE:
                                    if ($model->event_membership_type_id == EventMembershipType::TYPE_OPEN) {
                                        $label = AmosEvents::t('amosevents', 'Already subscribed');
                                    }
                                    if ($model->event_membership_type_id == EventMembershipType::TYPE_ON_INVITATION) {
                                        $label = AmosEvents::t('amosevents', 'Invitation accepted');
                                    }

                                    if ($issetCwh) {
                                        $scope = $cwhModule->getCwhScope();
                                        if ((!empty($scope) && isset($scope['community'])) || (empty($scope) && (Yii::$app->controller->id == 'event') && (Yii::$app->controller->action->id == 'update'))) {
                                            $button['text'] = AmosEvents::t('amoslayout', '#back_to_event_scope');
                                            $button['url'] = Yii::$app->urlManager->createUrl(['/events/event/view', 'id' => $model->id, 'resetscope' => '1']);
                                            $button['options']['class'] = 'btn btn-navigation-primary btn-event-success';
                                        } else {
                                            if ($showGoToCommunityButton) {
                                                $button['text'] = AmosEvents::t('amosevents', 'Go to the community');
                                                $button['url'] = Yii::$app->urlManager->createUrl(['/community/join', 'id' => $model->community_id]);
                                                $button['options']['class'] = 'btn btn-navigation-primary btn-event-success';
                                            } else {
                                                $button['text'] = '';
                                                $button['url'] = null;
                                                $button['options']['class'] = '';
                                            }
                                        }
                                    } else {
                                        if ($showGoToCommunityButton) {
                                            $button['text'] = AmosEvents::t('amosevents', 'Go to the community');
                                            $button['url'] = Yii::$app->urlManager->createUrl(['/community/join', 'id' => $model->community_id]);
                                            $button['options']['class'] = 'btn btn-navigation-primary btn-event-success';
                                        } else {
                                            $button['text'] = '';
                                            $button['url'] = null;
                                            $button['options']['class'] = '';
                                        }
                                    }
                                    break;
                            }
                        }
                        $hideButton = $hideButton || (isset(Yii::$app->params['isPoi']) && (Yii::$app->params['isPoi'] === true) && ($community->id == 2965));
                        ?>
                        <?php if (!$hideButton): ?>
                            <?=
                                    Html::a($button['text'], $button['url'], $button['options'])
                            ?>
                        <?php endif; ?>
                        <!-- ICS download -->
                        <?php
                        if (EventsUtility::checkManager($model)) {
                            echo Html::a(
                                Module::t('amoslayout', '#add_event_calendar'),
                                [
                                    '/events/event/force-download-ics',
                                    'eid' => $model->id,
                                ],
                                [
                                    'class' => 'btn link_calendar',
                                ]
                            );
                        } else {
                            $invitation = $eventInvitationModel::findOne(['user_id' => \Yii::$app->user->id, 'event_id' => $model->id]);
                            if ($invitation && !empty($invitation)) {
                                echo Html::a(
                                    Module::t('amoslayout', '#add_event_calendar'),
                                    [
                                        '/events/event/download-ics',
                                        'eid' => $model->id,
                                        'iid' => $invitation->id,
                                        'code' => $invitation->code,
                                    ],
                                    [
                                        'class' => 'btn link_calendar',
                                    ]
                                );
                            }
                        }
                        ?>
                        <!-- ICS download -->

                        <?php
                        if ($userInList) {
                            //TODO DISISCRIVITI -- Stefanoni
                            //echo Module::t("amosevents", "Already subscribed");
                        }
                        ?>

                        <div class="wrap-icons">
                            <!--                            < ?= Html::a(\open20\amos\core\icons\AmosIcons::show('modifica', [],-->
                            <!--                                \open20\amos\core\icons\AmosIcons::IC),-->
                            <!--                                '/events/event/update?id='.$model->id, ['class' => 'btn btn-icon'])-->
                            <!--                            ?>-->
                            <?php
                            $url = !empty(\Yii::$app->params['platform']['backendUrl']) ? \Yii::$app->params['platform']['backendUrl'] : "";
                            echo \open20\amos\core\forms\editors\socialShareWidget\SocialShareWidget::widget([
                                'mode' => \open20\amos\core\forms\editors\socialShareWidget\SocialShareWidget::MODE_DROPDOWN,
                                'configuratorId' => 'socialShare',
                                'model' => $model,
                                'url' => \yii\helpers\Url::to($url . '/events/event/public?id=' . $model->id, true), //TODO VIEW
                                'title' => $model->title,
                                //'description'   => $model->descrizione_breve,
                                'imageUrl' => $url,
                            ]);
                            ?>

                            <?php
                            $reportModule = \Yii::$app->getModule('report');
                            if (isset($reportModule) && in_array($model->className(), $reportModule->modelsEnabled)) {
                                echo \open20\amos\report\widgets\ReportDropdownWidget::widget([
                                    'model' => $model,
                                ]);
                            }
                            ?>

                            <?php echo CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true]) ?>

                            <?php echo ContextMenuWidget::widget([
                                'model' => $model,
                                'actionModify' => "/events/event/update?id=" . $model->id,
                                'optionsModify' => [
                                    'class' => 'event-modify',
                                ],
                                'actionDelete' => "/events/event/delete?id=" . $model->id,
                                'layout' => '@vendor/open20/amos-layout/src/views/widgets/context_menu_widget_network_scope.php'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
