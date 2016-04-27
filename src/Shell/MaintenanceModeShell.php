<?php

namespace Lemon\CakePlugin\MaintenanceMode\Shell;

use Cake\Console\Shell;

/**
 * Maintenance Mode Shell
 */
class MaintenanceModeShell extends Shell
{
    /**
     * Gets the option parser instance and configures it.
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $options = [
            'force' => [
                'short' => 'f',
                'help' => __d('cake_console', 'Run with default value.'),
                'boolean' => true,
                'default' => false,
            ],
        ];

        $parser = parent::getOptionParser();
        $parser
            ->description(__d('cake_console', 'Enable or disable maintenance mode'))
            ->addSubcommand('enable', [
                'help' => __d('cake_console', 'Enable maintenance mode. Default it will enable maintenance mode within an hour from now.'),
                'parser' => compact('options')
            ])
            ->addSubcommand('disable', [
                'help' => __d('cake_console', 'Disable maintenance mode'),
                'parser' => compact('options')
            ])
        ;

        return $parser;
    }

    /**
     * Enable maintenance mode
     */
    public function enable()
    {
        // Default config
        $config = [
            'viewClass' => 'App\View\AppView',
            'templatePath' => 'Pages',
            'templateFile' => 'maintenance',
            'templateLayout' => 'default',
            'startAt' => date('YmdHis'),
            'endAt' => date('YmdHis', strtotime('+1 hour')),
        ];

        // Ask custom maintenance config
        if (!$this->param('force')) {
            // Questions
            $questions = [
                'viewClass' => 'Application view class name',
                'templatePath' => 'Template path',
                'templateFile' => 'Template script file',
                'templateLayout' => 'Layout for render template',
                'startAt' => 'Start at',
                'endAt' => 'End at',
            ];

            foreach ($config as $key => $value) {
                $config[$key] = $this->in($questions[$key], null, $value);
            }
        }

        // Save to file
        $content = sprintf("<?php\nreturn %s;", var_export($config, true));
        if (false !== file_put_contents(MAINTENANCE_CONFIG_FILE, $content)) {
            $this->success('Maintenance mode is enabled');
            $this->_stop(0);
        } else {
            $this->success('Maintenance mode can\'t enable');
            $this->_stop(1);
        }
    }

    /**
     * Disable maintenance mode
     *
     * @return void
     */
    public function disable()
    {
        // check maintenance mode is enabled
        if (!is_file(MAINTENANCE_CONFIG_FILE) || !is_readable(MAINTENANCE_CONFIG_FILE)) {
            return;
        }

        // confirm: Do you want disable maintenance mode?
        if (!$this->param('force')) {
            $confirm = $this->in('Do you want disable maintenance mode?', ['y', 'n'], 'y');
            if ('y' !== $confirm) {
                return;
            }
        }

        // delete maintenance config file to disable maintenance mode
        if (@unlink(MAINTENANCE_CONFIG_FILE)) {
            $this->success('Maintenance mode is disabled');
            $this->_stop(0);
        } else {
            $this->err('Maintenance mode can\'t disable');
            $this->_stop(1);
        }
    }
}