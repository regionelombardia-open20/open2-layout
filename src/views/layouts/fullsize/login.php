<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    open20\amos\core
 * @category   CategoryName
 */

/* @var $this \yii\web\View */
/* @var $content string */

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head", [
        'title' => ((Yii::$app->get('menu', false)) && !empty($this->params['titleSection'])) ? $this->params['titleSection'] : $this->title
    ]); ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="login-page col-lg-4 col-md-6 col-sm-6 col-xs-12 col-lg-push-4 col-md-push-3 col-sm-push-3 nop">

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>

    <div class="col-xs-12 dropdown-languages">
        <?php
        $headerMenu = new \open20\amos\core\views\common\HeaderMenu();
        $menuLang = $headerMenu->getListLanguages();
        echo $menuLang;
        ?>
    </div>
    <div class="clearfix"></div>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo_login"); ?>

    <?= $content ?>

</div>

<div class="clearfix"></div>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer_text"); ?>

<?= $this->render("parts" . DIRECTORY_SEPARATOR . "assistance"); ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
