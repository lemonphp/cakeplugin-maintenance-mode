<?php
/**
 * This file is part of `lemonphp/cakeplugin-maintenance-mode` project.
 *
 * (c) 2015-2016 LemonPHP Team
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Lemon\CakePlugin\MaintenanceMode\Routing\Filter;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Routing\DispatcherFilter;

/**
 * Maintenance mode filter
 * Show maintenance page when maintenance mode is enabled
 *
 * @author Oanh Nguyen <oanhnn.bk@gmail.com>
 */
class MaintenanceModeFilter extends DispatcherFilter
{
    /**
     * Default priority for all methods in this filter
     * This filter should run before the request gets parsed by router
     *
     * @var int
     */
    protected $_priority = -1;

    /**
     * Returns the list of events this filter listens to.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [
            'Dispatcher.beforeDispatch' => [
                'callable' => 'handle',
                'priority' => $this->_config['priority']
            ],
        ];
    }

    /**
     * Handler method that applies before dispatch.
     *
     * @param \Cake\Event\Event $event The event instance.
     * @return mixed
     */
    public function handle(Event $event)
    {
        $config = Configure::read('maintenance_mode');
        if (is_file($config['lockFile'])) {
            // stop event
            $event->stopPropagation();

            $request = $event->data['request'];
            $response = $event->data['response'];

            $viewClass = $config['viewClass'];

            /*@var $view \Cake\View\View */
            $view = new $viewClass($request, $response);
            $view->templatePath($config['templatePath']);
            $view->template($config['templateFile']);
            $view->layout($config['templateLayout']);

            // Set view vars
            foreach ($config['viewVars'] as $key => $value) {
                $view->set($key, $value);
            }

            $response->body($view->render());

            return $response;
        }
    }
}
