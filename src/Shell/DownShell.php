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
 * Down Shell
 *
 * Enable maintenance mode
 *
 * @author Oanh Nguyen <oanhnn.bk@gmail.com>
 */
class DownShell extends Shell
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
            ->description(__d('cake_console', 'Enable maintenance mode'))
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
     * Enable maintenance mode
     */
    public function main()
    {
        $config = Configure::read('maintenance_mode');

        // check maintenance mode is enabled
        if (is_file($config['lockFile'])) {
            $this->success(__d('cake_console', 'Maintenance mode is already enabled'));
            return $this->_stop(0);
        }

        // confirm: Do you want disable maintenance mode?
        if (!$this->param('force')) {
            $confirm = $this->in(__d('cake_console', 'Do you want enable maintenance mode?'), ['y', 'n'], 'n');
            if ('y' !== $confirm) {
                return $this->_stop(0);
            }
        }

        // Save to file
        if (false !== file_put_contents($config['lockFile'], date('YmdHis'))) {
            $this->success(__d('cake_console', 'Maintenance mode is enabled'));
            $this->_stop(0);
        } else {
            $this->success(__d('cake_consle', 'Maintenance mode can\'t enable'));
            $this->_stop(1);
        }
    }
}
