<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

// Set timezone
date_default_timezone_set('UTC');

// Enable Composer autoloader
/** @var \Composer\Autoload\ClassLoader $autoloader */
$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';

// Register test classes
$autoloader->addPsr4('Lemon\\CakePlugin\\MaintenanceMode\\Tests\\', __DIR__);
$autoloader->addPsr4('Cake\\Test\\', dirname(__DIR__) . '/vendor/cakephp/cakephp/tests');
