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

//use yii\bootstrap4\Breadcrumbs;
use yii\widgets\Breadcrumbs;

$isVisible = isset(Yii::$app->params['layoutConfigurations']['hideBreadCrumb']) ? !Yii::$app->params['layoutConfigurations']['hideBreadCrumb']
        : true;
?>

<?php if (!empty($this->params['breadcrumbs']) && $isVisible) : ?>

    <?php
    $homeLink           = '<span class="am am-home"></span>';
    $containerClass     = 'breadcrumb mb-1';
    $itemTemplate       = '<li class="breadcrumb-item">{link}<span class="separator">/</span></li>'; //BS3 inserisce before in automatico
    // $itemTemplate = '<li class="breadcrumb-item">{link}</li>';
    $activeItemTemplate = '<li class="breadcrumb-item active">{link}</li>';
    $tag                = 'ol';
    ?>

    <nav class="breadcrumb-container" aria-label="breadcrumb">

        <?=
        Breadcrumbs::widget([
            'encodeLabels' => false,
            'tag' => $tag,
            'itemTemplate' => $itemTemplate,
            'activeItemTemplate' => $activeItemTemplate,
            'homeLink' => [
                'label' => (!empty(\Yii::$app->params['homeName']) ? \Yii::$app->params['homeName'] : $homeLink),
                'url' => ((!empty(\Yii::$app->params['befe']) && \Yii::$app->params['befe'] == true) ? '/site/to-menu-url?url='.Yii::$app->homeUrl
                        : Yii::$app->homeUrl),
                'encode' => false,
                'title' => Yii::t('amosplatform', 'Vai alla homepage')
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
                'class' => $containerClass
            ]
        ])
        ?>

    </nav>


<?php endif; ?>