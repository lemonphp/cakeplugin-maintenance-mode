<?php
use Cake\Routing\DispatcherFactory;
use Lemon\CakePlugin\MaintenanceMode\Routing\Filter\MaintenanceModeFilter;

defined('MAINTENANCE_CONFIG_FILE') || define('MAINTENANCE_CONFIG_FILE', TMP . 'maintenance.php');

DispatcherFactory::add(MaintenanceModeFilter::class);
