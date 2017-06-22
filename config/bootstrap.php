<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Cake\Core\Configure;
use Cake\Routing\DispatcherFactory;
use Lemon\CakePlugin\MaintenanceMode\Routing\Filter\MaintenanceModeFilter;

DispatcherFactory::add(MaintenanceModeFilter::class);

$defaults = [
    'lockFile' => TMP . 'maintenance.php',
    'viewClass' => 'App\View\AppView',
    'templatePath' => 'Pages',
    'templateFile' => 'maintenance',
    'templateLayout' => 'default',
    'viewVars' => [],
];

Configure::write('maintenance_mode', array_merge($defaults, (array) Configure::read('maintenance_mode')));

unset($defaults);
