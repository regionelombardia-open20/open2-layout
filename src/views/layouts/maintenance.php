<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\core
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

use yii\helpers\Html;

/* @var $this \yii\web\View */

$js = $this->registerJs('
// Full Screen Slider
(function () {
    // $(".bg-fullHeight").height($(window).height()-$("footer").outerHeight()-$(".header-wrapper").outerHeight()); // TODO FIX
    $(".bg-fullHeight").height($(window).height());

    $(window).resize(function(){
        $(".bg-fullHeight").height($(window).height()-$("footer").outerHeight()-$(".header-wrapper").outerHeight());
    });
}());
');
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render("parts".DIRECTORY_SEPARATOR."head"); ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    

    <!-- BEGIN: header  -->
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo text-center">
                        <?=
                        /** @var string $logo */
                        $logo = isset(Yii::$app->params['logo']) ?
                            Html::img(Yii::$app->params['logo'], [
                                'class' => 'logo-under-construction',
                                'alt' => 'logo ' . Yii::$app->name
                            ])
                            : Html::encode($this->title);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: header  -->

    <section class="under-construction bg-fullHeight">
        <?= $content ?>
    </section>

    <?= $this->render("parts".DIRECTORY_SEPARATOR."footer"); ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>