<?php 
use open20\amos\layout\Module;
?>

<div class="bi-assistance z-index-1031">
    <a class="d-flex align-items-center justify-content-center border border-primary" href="<?= $isMail ? 'mailto:' . $mailAddress :  $urlAssistance ?>" data-toggle="tooltip" title="<?= Module::t('amosdesign', 'Hai bisogno di assistenza?') ?>">
      <span class="mdi mdi-help"></span>
     
    </a>
    <span class="sr-only"><?= Module::t('amosdesign', 'Verrà aperta una nuova finestra') ?></span>
  </div>