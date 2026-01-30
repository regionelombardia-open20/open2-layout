<?php

namespace open20\amos\layout\utility;

class LayoutUtility
{
    public static function isEnabledNewCommunityScope()
    {
        $moduleCwh = \Yii::$app->getModule('cwh');
        $isLayoutInScope = false;
        $newCommunityLayout = false;
        $classContainer = '';
        if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
            $scope = $moduleCwh->getCwhScope();
            $isLayoutInScope = (!empty($scope)) ? true : false;
            if (isset($scope['community'])) {
                $moduleCommunity = \Yii::$app->getModule('community');
                if ($moduleCommunity->hasProperty('enableNewCommunityHeader') && $moduleCommunity->enableNewCommunityHeader) {
                    $newCommunityLayout = true;
                    $classContainer = 'container';
                }
            }
        }

        return [
            'isLayoutInScope' => $isLayoutInScope,
            'newCommunityLayout' => $newCommunityLayout,
            'classContainer' => $classContainer
        ];

    }

}