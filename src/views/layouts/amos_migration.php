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

/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */

echo "<?php\n";
?>

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class <?= $className ?> extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'ROLE_ONE',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Role description',
                'ruleName' => null,     // This is a string
            ],
            [
                'name' => 'ROLE_TWO',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Role description',
                'ruleName' => null,     // This is a string
                'parent' => ['ROLE_ONE']
            ],
            [
                'name' => 'PERMISSION_NAME',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission description',
                'ruleName' => null,     // This is a string
                'parent' => ['ROLE_ONE']
            ],
            [
                'name' => 'PERMISSION_NAME',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission description',
                'ruleName' => null,     // This is a string
                'parent' => ['ROLE_ONE', 'ROLE_TWO']
            ],
        ];
    }
}
