<?php

use open20\amos\layout\Module;

use open20\amos\core\icons\AmosIcons;

?>
<?php
$currentAction = $this->context->action->id;
$currentController = Yii::$app->controller->id;
?>

<nav class="sidebarForm white-color neutral-2-bg-a6 collapse" id="sidebarForm">

  <div class="sidebar-sticky sidebar-content py-4">
    <ul class="nav flex-md-column justify-content-center">
      <li class="nav-item active">
        <div class="step-sidebar">
          <a class="nav-link align-items-center d-flex">
            <div class="mx-auto text-center">
            <?= AmosIcons::show('email', ['class' => 'icon icon-white'], 'am') ?>
              <div>Item</div>
            </div>
          </a>
        </div>
        <div>
            <ul class="nav sub-nav flex-column justify-content-center text-center">
                    <li class="nav-item active">
                        <a href="#" title="...">label</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" title="...">label</a>
                    </li>

            </ul>
        </div>
      </li>

      <!-- < ?php


            if (!empty(\Yii::$app->getView()->params['bi-menu-sidebar'])) {
                $menuSidebar = \Yii::$app->getView()->params['bi-menu-sidebar'];
                foreach ($menuSidebar as $item){
                    $sidebarParams = [
                        'currentAsset' => $currentAsset,
                        'currentAction' => $currentAction,
                        'currentController' => $currentController,
                    ];
                    $sidebarParams = \yii\helpers\ArrayHelper::merge($sidebarParams, $item);
                    echo $this->render('_sidebarPluginMenuCollapse', $sidebarParams);
                }
            }
            ?> -->
    </ul>
  </div>
</nav>