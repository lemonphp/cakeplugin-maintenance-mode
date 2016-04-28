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
        if (is_file(MAINTENANCE_CONFIG_FILE) && is_readable(MAINTENANCE_CONFIG_FILE)) {
            // stop event
            $event->stopPropagation();

            $request = $event->data['request'];
            $response = $event->data['response'];
            $config = require MAINTENANCE_CONFIG_FILE;

            $viewClass = $config['viewClass'];

            $view = new $viewClass($request, $response);
            $view->templatePath($config['templatePath']);
            $view->template($config['templateFile']);
            $view->layout($config['templateLayout']);

            $view->set('startAt', \Cake\I18n\Time::createFromFormat('YmdHis', $config['startAt']));
            $view->set('endAt', \Cake\I18n\Time::createFromFormat('YmdHis', $config['endAt']));

            $response->body($view->render());

            return $response;
        }
    }
}