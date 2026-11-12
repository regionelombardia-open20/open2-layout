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
use open20\amos\community\models\CommunityType;
use open20\amos\community\widgets\JoinCommunityWidget;
use open20\amos\core\forms\ContextMenuWidget;
use open20\amos\core\helpers\Html;
use open20\amos\layout\assets\BaseAsset;
use open20\amos\layout\Module;
use open20\amos\core\forms\CreatedUpdatedWidget;
use open20\amos\report\widgets\ReportDropdownWidget;

$asset = BaseAsset::register($this);

$moduleCommunity = Yii::$app->getModule('community');
if (isset($community)) {
    open20\amos\community\assets\AmosCommunityAsset::register($this);
    $viewUrl            = ['/community/join/index?id='.$community->id];
    $exitUrl            = (!empty(\Yii::$app->homeUrl)? \Yii::$app->homeUrl : ['/dashboard']);
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    $team = \amos\challenge\models\ChallengeTeam::find()->andWhere(['community_id' => $community->id])->one();
    $urlImageTeam = !empty($team->mainImage) ? $team->mainImage->getUrl('scope_community', false, true) : null;
    ?>
    <div class="network-container community-network-container fullscreen-network-container">
        <!-- BEGIN: community data -->
        <div class="network-box">
            <img src="<?= $asset->baseUrl ?>/img/bg-community.jpg">

            <div class="network-infos">
                <div class="container-custom">
                    <div class="header-community">
                        <div class="poster-community">
                            <?php
                            $url = '/img/img_default.jpg';
                            if (!empty($urlImageTeam)) {
                                $url = $urlImageTeam;
                            }
                            //            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
                            //            $roundImage = Yii::$app->imageUtility->getRoundImage((empty($community->communityLogo)
                            //                ? null : $community->communityLogo));

                            echo $logo = Html::img($url,
                                [
                                    'alt' => $community->getAttributeLabel('communityLogo')
                                ]);
                            ?>
                        </div>
                        <div class="control-community">
                            <!--< ?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>-->
<!--                            --><?php //$communityName = ''; ?>
<!--                            --><?php //$communityName = Html::a($community->name, $viewUrl,
//                                [
//                                    'title' => Module::t("amoscommunity", "View community"),
//                                    'data' => $confirm
//                                ]) ?>

                            <h1 class="network-name"><?= $community->name ?></h1>

                            <?php if (!$fixedCommunityType): ?>
                                <?php
                                switch ($community->community_type_id):
                                    case CommunityType::COMMUNITY_TYPE_CLOSED :
                                        $classType = 'closed';
                                        break;
                                    case CommunityType::COMMUNITY_TYPE_OPEN :
                                        $classType = 'open';
                                        break;
                                    case CommunityType::COMMUNITY_TYPE_PRIVATE :
                                        $classType = 'private';
                                        break;
                                    default:
                                        $classType = '';
                                endswitch;
                                ?>
                            <div class="community-status <?= $classType ?>"><?= Module::t('amoscommunity', $community->communityType->name) ?></div>
                            <?php endif; ?>
                            <p> <?= Module::t("amoslayout", "Benvenuto nell'area di lavoro del tuo team") ?> </p>
                        </div>

                        <div class="network-footer">
                            <?php
                            //community view
                            if (isset($this->params['CommunityParams']['outsideCommunity']) && $this->params['CommunityParams']['outsideCommunity']):
                                ?>
                                <?=
                                JoinCommunityWidget::widget([
                                'model' => $community,
                                'isProfileView' => true,
                                'btnClass' => 'enter-community',
                                    ])


                                    ?>

<!--                                <div class="wrap-icons">-->
<!---->
<!--                                    < ?= ReportDropdownWidget::widget([-->
<!--                                        'model' => $community,-->
<!--                                    ])-->
<!--                                    ?>-->
<!---->
<!--                                    < ?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>-->
<!---->
<!--                                    < ?= ContextMenuWidget::widget([-->
<!--                                        'model' => $community,-->
<!--                                        'actionModify' => "/community/community/update?id=" . $community->id,-->
<!--                                        'optionsModify' => [-->
<!--                                            'class' => 'community-modify',-->
<!--                                        ],-->
<!--                                        'actionDelete' => "/community/community/delete?id=" . $community->id,-->
<!--                                        'layout' => '@vendor/open20/amos-layout/src/views/widgets/context_menu_widget_network_scope.php'-->
<!--                                    ]) ?>-->
<!--                                </div>-->
                            <?php
                            else:
                                //community dashboard
                                ?>

                                <?=
                                Html::a(Module::t('amoslayout', '#network_scope_exit_from_community'),
                                    $exitUrl,
                                    [
                                'class' => 'back-to-dashboard'
                                ]);
                                ?>

                                <?php if (\Yii::$app->user->can('COMMUNITY_UPDATE',
                                        ['model' => $community])) : ?>
                                    <?php echo
                                    Html::a(\open20\amos\core\icons\AmosIcons::show('modifica', [],
                                            \open20\amos\core\icons\AmosIcons::IC),
                                        '/challenge/challenge-team/update?id='.$team->id, ['class' => 'btn btn-icon'])
                                ?>
                                 <?php endif; ?>

                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
