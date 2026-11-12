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

use open20\amos\core\controllers\CrudController;
use open20\amos\core\icons\AmosIcons;
use yii\helpers\Inflector;
use open20\amos\layout\assets\BootstrapItaliaCustomSpriteAsset;
use yii\helpers\Html;

$spriteAsset = BootstrapItaliaCustomSpriteAsset::register($this);

/** @var \yii\web\View $this */
?>
<?php if (!empty($this->params['enableLayoutList']) && $this->params['enableLayoutList'] == true) { ?>

<div class="container-search">

    <?php

    //SEARCH ENABLED?
    $paramsSearch = false;
    $searchActive = false;
    if (
        isset(\Yii::$app->controller->module)
        &&
        isset(\Yii::$app->controller->module->params)
        &&
        isset(\Yii::$app->controller->module->params['searchParams'])
        &&
        isset(\Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id])
        &&
        (
            (is_array(\Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id])
                &&
                isset(\Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id]['enable'])
                &&
                \Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id]['enable'])
            ||
            (is_bool(\Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id])
                &&
                \Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id]))
    ) {
        //check if the controller is istance of CrucController to retrieve the setted searchModel
        if (\Yii::$app->controller instanceof CrudController) {
            //retrieve the form name of current modelSearch
            $modelSearch = \Yii::$app->controller->getModelSearch();
            $classSearch = $modelSearch->formName();
        } else {
            //use the previous mode to calculate the modelSearch name
            $classSearch = Inflector::id2camel(\Yii::$app->controller->id, '-') . 'Search';
        }

        $paramsSearch = \Yii::$app->controller->module->params['searchParams'][\Yii::$app->controller->id];
        if (
            isset(Yii::$app->request->queryParams[$classSearch])
            &&
            isset(Yii::$app->request->queryParams['enableSearch'])
            &&
            Yii::$app->request->queryParams['enableSearch']
        ) {
            $searchActive = TRUE;
        }
    }
    if ($paramsSearch) {

    ?>
        <a class="btn btn-outline-secondary btn-sm btn-icon mb-3" data-toggle="collapse" href="#form-search-events" role="button" aria-expanded="false" aria-controls="form-search-events">
            <svg class="icon">
                <use xlink:href="<?= $spriteAsset->baseUrl ?>/material-sprite.svg#ic_search"></use>
            </svg>
            <span><?= \Yii::t('app','Cerca')?></span>
        </a>

    <?php
    }
    ?>

</div>
<?php  } ?>