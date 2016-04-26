<?php

namespace Lemon\CakePlugin\MaintenanceMode\Shell;

use Cake\Core\Configure;
use Cake\Console\Shell;

class MaintenanceModeShell extends Shell
{
    const ENABLE = 'enanle';
    const DISABLE = 'disable';

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser
            ->description(__d('cake_console', 'Enable or disable maintenance mode'))
            ->addArguments([
                'action' => [
                    'help' => __d('cake_console', 'Enable or disable maintenance mode.'),
                    'required' => true,
                    'index' => 0,
                    'choices' => [self::ENABLE, self::DISABLE],
                ],
                'vars' => [
                    'help' => __d('cake_console', 'An associative array, that is variables for maintenance mode view.'),
                    'required' => false,
                    'index' => 1,
                ],
            ])
        ;

        return $parser;
    }

    public function main()
    {
        $action = $this->args[0];
        $vars = isset($this->args[1]) ? $this->args[1] : [];

        $vars = array_merge(Configure::read('MaintenanceMode.view.vars'), $vars);
        $lockFile = Configure::read('MaintenaceMode.lockFile');
        if (self::ENABLE == $action) {

        }
    }
}