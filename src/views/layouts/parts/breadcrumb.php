<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\core
 * @category   CategoryName
 */
use yii\widgets\Breadcrumbs;
use lispa\amos\core\helpers\Html;

/* $urlCorrente = yii\helpers\Url::current();
  $posizioneEsclusione = strpos($urlCorrente, '?');
  $urlParametro = $urlCorrente;
  if ($posizioneEsclusione > 0) {
  $urlParametro = preg_quote(substr($urlCorrente, 0, $posizioneEsclusione));
  }
  $urlFaq = Yii::$app->getUrlManager()->createUrl(['/faq/faq', 'FaqSearch[rotte]' => $urlParametro]); */
?>
<?php
if (!empty($this->params['breadcrumbs'])):
    foreach ((array) $this->params['breadcrumbs'] as $key => $value) {
        if (!isset($value['title']) && !empty($value['label'])) {
            $this->params['breadcrumbs'][$key]['title'] = $this->params['breadcrumbs'][$key]['label'];
        }
    }
    ?>
    <div class="breadcrumb_left">
        <?php
        $session = Yii::$app->session;
        if (!empty(\Yii::$app->params['isPoi']) && \Yii::$app->params['isPoi'] == true && isset($session["cwh-scope"]) && !empty($session['cwh-scope']['community'])
            && $session['cwh-scope']['community'] == 2750) {
            ?>
            <?=
            Breadcrumbs::widget([
                'homeLink' => [
                    'label' => '',
                    'url' => '',
                    'encode' => false,
                    'title' => ''
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
        <?php } else { ?>
            <?=
            Breadcrumbs::widget([
                'homeLink' => [
                    'label' => (!empty(\Yii::$app->params['homeName'])? \Yii::$app->params['homeName'] : \Yii::t('amoscore', 'Dashboard')),
                    'url' => Yii::$app->homeUrl,
                    'encode' => false,
                    'title' => 'home'
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
        <?php } ?>
    </div>
<?php endif; ?>
<!--div id="bk-generalTools" class="show breadcrumb-tools">
    <a href="<?php //echo $urlFaq;   ?>"><button>
        <span>FAQ</span><span class="sr-only">Leggi le faq relative al plugin</span>
        </button></a>
</div-->