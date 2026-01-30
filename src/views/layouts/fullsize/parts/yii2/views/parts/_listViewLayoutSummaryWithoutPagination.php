<?php
use open20\amos\layout\Module;

$modelLabel = (isset($modelLabel)) ? $modelLabel : Module::t('amoslayout','elementi');
?>

<?php if ($showCounterElement) { ?>
    <p><?=Module::t('amoslayout','Visualizzati') . ' ' ?>{count}<?=' ' . Module::t('amoslayout','{modelLabel}',['modelLabel' => $modelLabel]);?>
<?php } ?>

