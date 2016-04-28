<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Cake\Routing\DispatcherFactory;
use Lemon\CakePlugin\MaintenanceMode\Routing\Filter\MaintenanceModeFilter;

defined('MAINTENANCE_CONFIG_FILE') || define('MAINTENANCE_CONFIG_FILE', TMP . 'maintenance.php');

DispatcherFactory::add(MaintenanceModeFilter::class);
