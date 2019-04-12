<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\layout\views\layouts\parts
 * @category   CategoryName
 */

use lispa\amos\core\forms\ContextMenuWidget;
use lispa\amos\core\forms\CreatedUpdatedWidget;
use lispa\amos\core\helpers\Html;
use lispa\amos\layout\Module;

$moduleCommunity = Yii::$app->getModule('community');
if (isset($community)) {
    if (!empty(\Yii::$app->params['isPoi']) && \Yii::$app->params['isPoi'] == true && $community->id == 2750) {
        $viewUrl = ['/community/join/index?id=2750'];
    } else {
        $viewUrl = $community->getFullViewUrl();
    }
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    ?>

    <div class="network-container community-network-container col-xs-12 nop">
        <div class="col-xs-12 back-to-dashboard">
            <?=
            Html::a(
                Html::tag('span', '', ['class' => 'am am-mail-reply-all']) .
                Html::tag('span', Module::t('amoslayout', '#network_scope_exit_from_community')), Yii::$app->homeUrl
            );
            ?>
        </div>

        <!-- BEGIN: community data -->
        <div class="network-box col-xs-12 col-sm-12 col-lg-12">
            <?php
            $url = '/img/img_default.jpg';
            if (!empty($community->communityLogo)) {
                $url = $community->communityLogo->getUrl('square_large', false, true);
            }
            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
            $roundImage = Yii::$app->imageUtility->getRoundImage((empty($community->communityLogo)
                ? null : $community->communityLogo));
            $logo = Html::img($url,
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
                    'actionModify' => "/community/community/update?id=" . $community->id,
                    'disableDelete' => true,
                    'mainDivClasses' => ''
                ])
                ?>
                <?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>
                <?php $communityName = ''; ?>
                <?php
                $communityName = Html::a($community->name, $viewUrl,
                    [
                        'title' => Module::t("amoscommunity", "View community"),
                        'data' => $confirm
                    ])
                ?>
                <?php if (!$fixedCommunityType): ?>
                    <p class="network-info">
                        <span class="network-type"><?= $community->communityType->name ?></span>
                        <span class="network-created-by"><?= Module::tHtml('amoscommunity', 'Created by') . ' ' . '<strong>' . $community->createdByUser->profile->__toString() . '</strong>'; ?></span>
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
