<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\admin\controllers
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

namespace open20\amos\layout\controllers;

use open20\amos\admin\models\UserProfileReactivationRequest;
use open20\amos\core\controllers\BackendController;
use open20\amos\core\forms\FirstAccessForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


/**
 * Class SecurityController
 * @package open20\amos\admin\controllers
 */
class ErrorController extends BackendController
{
    /**
     * @var string $layout
     */
    public $layout = 'error';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setUpLayout();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'error',
                        ],
                        'allow' => true,
                    ],

                ],
            ],
        ];
    }


    public function actionIndex(){
        $this->redirect(['errors']);
    }

    /**
     * Maintenance action
     * @return string
     */
    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('errors', ['exception' => $exception]);
        }
    }

}
