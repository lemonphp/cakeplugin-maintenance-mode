<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lemon\CakePlugin\MaintenanceMode\Shell;

use Cake\Core\Configure;
use Cake\Console\Shell;

/**
 * Up Shell
 *
 * Disable maintenance mode from CLI
 *
 * @author Oanh Nguyen <oanhnn.bk@gmail.com>
 */
class UpShell extends Shell
{
    /**
     * Gets the option parser instance and configures it.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser
            ->description(__d('cake_console', 'Enable or disable maintenance mode'))
            ->addOption('force', [
                'short' => 'f',
                'help' => __d('cake_console', 'Run without confirmation prompt.'),
                'boolean' => true,
                'default' => false,
            ])
        ;

        return $parser;
    }

    /**
     * Disable maintenance mode
     */
    public function main()
    {
        $config = Configure::read('maintenance_mode');

        // check maintenance mode is enabled
        if (!is_file($config['lockFile'])) {
            $this->success(__d('cake_console', 'Maintenance mode is already disabled'));
            return $this->_stop(0);
        }

        // confirm: Do you want disable maintenance mode?
        if (!$this->param('force')) {
            $confirm = $this->in(__d('cake_console', 'Do you want disable maintenance mode?'), ['y', 'n'], 'y');
            if ('y' !== $confirm) {
                return $this->_stop(0);
            }
        }

        // delete maintenance config file to disable maintenance mode
        if (@unlink($config)) {
            $this->success(__d('cake_console', 'Maintenance mode is disabled'));
            $this->_stop(0);
        } else {
            $this->err(__d('cake_console', 'Maintenance mode can\'t disable'));
            $this->_stop(1);
        }
    }
}
