<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
// @codingStandardsIgnoreFile

use Cake\Core\Plugin;

$findRoot = function ($root) {
    do {
        $lastRoot = $root;
        $root = dirname($root);
        if (is_dir($root . '/vendor/cakephp/cakephp')) {
            return $root;
        }
    } while ($root !== $lastRoot);
    throw new \Exception('Cannot find the root of the application, unable to run tests');
};

$root = $findRoot(__FILE__);
unset($findRoot);
chdir($root);

require $root . '/vendor/cakephp/cakephp/tests/bootstrap.php';

$loader = require $root . '/vendor/autoload.php';

$loader->setPsr4('Cake\\', $root . '/vendor/cakephp/cakephp/src');
$loader->setPsr4('Cake\Test\\', $root . '/vendor/cakephp/cakephp/tests');
$loader->addPsr4('Lemon\\CakePlugin\\MaintenanceMode\\Tests\\', __DIR__);

// Load plugin
Plugin::load('Lemon/CakePlugin/MaintenanceMode', [
    'path' => dirname(dirname(__FILE__)) . DS,
    'bootstrap' => true
]);
