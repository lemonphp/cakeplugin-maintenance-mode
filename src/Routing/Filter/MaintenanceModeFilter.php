<?php

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
    protected $_priority = 99;

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


            $event->stopPropagation();

            $request = $event->data['request'];
            $response = $event->data['response'];
//            $viewClass = $this->config('view.class');
//
//            $view = new $viewClass($request, $response);
//            $view->templatePath($this->config('view.path'));
//            $view->template($this->config('view.template'));
//            $view->layout($this->config('view.layout'));
//
//            foreach ((array) $this->config('view.vars') as $key => $value) {
//                $view->set($key, $value);
//            }

//            $response->body($view->render());
            $response->body('Maintenance mode ON');

            return $response;
    }
}