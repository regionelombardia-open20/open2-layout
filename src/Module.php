<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\layout
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

namespace open20\amos\layout;

use open20\amos\core\module\AmosModule;
use open20\amos\core\module\ModuleInterface;
use open20\amos\layout\components\Layout;
use yii\base\BootstrapInterface;

/**
 * Class Module
 * @package open20\amos\socialauth
 */
class Module extends AmosModule implements ModuleInterface, BootstrapInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'open20\amos\layout\controllers';

    /**
     * View path of maintenance page
     * @var string $viewMaintenanceMode
     */
    public $viewMaintenanceMode = '@vendor/open20/amos-layout/src/views/maintenance/maintenance';
    
    /**
     * If this property contains a classname, it will be used to add items to the header nav and must implements the AddHeaderNavItemsInterface.
     * @var string
     */
    public $addHeaderNavItemsClass = '';

    /**
     * Choose to display a single logout action in the navbar or multiple ones
     * @var boolean $advancedLogoutActions
     */
    public $advancedLogoutActions = false;

    public $breadcrumbsIconHomeText = false;

    public $excludeNetworkView = ['amos\planner\models\PlanWork'];
    
    public $open2CommunityOrganizationView = false;
    

    /**
     * Encryption key
     * @var string $encryptionKey
     */
    public $encryptionKey = 'v1yxz2eDe-rrZHFsKxZ00DuGjGozxDMIp2LgxhaOChLdfG_OuWgIZw5qkuwCaVWy';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defineModelClasses();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        //Set Layout
        \Yii::$app->set('layout', Layout::className());
    }

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'layout';
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [

        ];
    }
}
