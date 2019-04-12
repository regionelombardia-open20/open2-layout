<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\core
 * @category   CategoryName
 */

use lispa\amos\core\icons\AmosIcons;
use yii\helpers\Html;

?>
<?php if ((isset(Yii::$app->params['footerText'])) && (Yii::$app->params['footerText'])): ?>
<div class="footer-space">
    <div class="footer-text-container">
        <div class="footer-text">
            <div class="container">
                <!-- code here -->
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$socialModule = \Yii::$app->getModule('social');
if (!is_null($socialModule) && class_exists('\kartik\social\GoogleAnalytics')):
    if (!empty($socialModule->googleAnalytics)):
        echo \kartik\social\GoogleAnalytics::widget([]);
    endif;
endif;
?>
