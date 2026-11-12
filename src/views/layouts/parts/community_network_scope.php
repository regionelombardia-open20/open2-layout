<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\layout\views\layouts\parts
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
use open20\amos\core\forms\ContextMenuWidget;
use open20\amos\core\forms\CreatedUpdatedWidget;
use open20\amos\core\helpers\Html;
use open20\amos\layout\Module;

$moduleCommunity = Yii::$app->getModule('community');
if (isset($community)) {
    $viewUrl            = ['/community/join/index?id='.$community->id];
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    ?>

    <div class="network-container community-network-container col-xs-12 nop">
        <div class="col-xs-12 back-to-dashboard">
            <?=
            Html::a(
                Html::tag('span', '', ['class' => 'am am-mail-reply-all']).
                Html::tag('span', Module::t('amoslayout', '#network_scope_exit_from_community')), Yii::$app->homeUrl
            );
            ?>
        </div>

        <!-- BEGIN: community data -->
        <div class="network-box col-xs-12 col-sm-12 col-lg-12">
            <?php
            $url                = '/img/img_default.jpg';
            if (!empty($community->communityLogo)) {
                $url = $community->communityLogo->getUrl('scope_community_old', false, true);
            }
            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
            $roundImage                                = Yii::$app->imageUtility->getRoundImage((empty($community->communityLogo)
                    ? null : $community->communityLogo));
            $logo                                      = Html::img($url,
                    [
                    'class' => $roundImage['class'],
                    'alt' => $community->getAttributeLabel('communityLogo')
            ]);
            ?>

            <div class="col-md-3 col-xs-12">
                <div class="container-square-img">
                    <?=
                    Html::a($logo, $viewUrl,
                        [
                        'title' => Module::t('amoscommunity', 'View community'),
                        'data' => $confirm
                        ]
                    )
                    ?>
                </div>
            </div>

            <div class="col-md-9 col-xs-12 network-infos">
                <?=
                ContextMenuWidget::widget([
                    'model' => $community,
                    'actionModify' => "/community/community/update?id=".$community->id,
                    'disableDelete' => true,
                    'mainDivClasses' => ''
                ])
                ?>
                <?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>
                <?php $communityName                             = ''; ?>
                <?php
                $communityName                             = Html::a($community->name, $viewUrl,
                        [
                        'title' => Module::t("amoscommunity", "View community"),
                        'data' => $confirm
                    ])
                ?>
                <?php if (!$fixedCommunityType): ?>
                    <p class="network-info">
                        <span class="network-type"><?= $community->communityType->name ?></span>
                        <span class="network-created-by"><?= Module::tHtml('amoscommunity', 'Created by').' '.'<strong>'.$community->createdByUser->profile->__toString().'</strong>'; ?></span>
                    </p>
                <?php endif; ?>
                <p class="network-name">
                    <?= $communityName ?>
                </p>
                <span class="network-bottom-label"><?= Module::t('amoslayout', '#network_scope_bottom_label_community') ?></span>
                <?php
                if (!empty(\Yii::$app->params['isPoi']) && \Yii::$app->params['isPoi'] == true && $community->id == 2750) {

                } else {
                    ?>

                    <?=
                    Html::a(Module::t('amoslayout', '#network_scope_view_details'), $viewUrl,
                        [
                        'title' => Module::t("amoscommunity", "View community"),
                        'class' => 'btn btn-primary pull-right',
                        'data' => $confirm
                    ])
                    ?>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
