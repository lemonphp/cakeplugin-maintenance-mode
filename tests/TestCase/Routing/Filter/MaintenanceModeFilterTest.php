<?php

namespace Lemon\CakePlugin\MaintenanceMode\Tests\TestCase\Routing\Filter;

use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\TestCase;
use Lemon\CakePlugin\MaintenanceMode\Routing\Filter\MaintenanceModeFilter;

class MaintenanceModeFilterTest extends TestCase
{
    /**
     * Test return of method `implementedEvents()`
     */
    public function testImplementedEvents()
    {
        $filter = new MaintenanceModeFilter();
        $return = $filter->implementedEvents();

        $this->assertArrayHasKey('Dispatcher.beforeDispatch', $return);
        $this->assertTrue(is_array($return['Dispatcher.beforeDispatch']));
        $this->assertArrayHasKey('callable', $return['Dispatcher.beforeDispatch']);
        $this->assertArrayHasKey('priority', $return['Dispatcher.beforeDispatch']);
    }

    /**
     * Test
     */
    public function testRunBeforeAll()
    {
        $response = $this->getMockBuilder(Response::class)
            ->setMethods(['_sendHeader'])
            ->getMock();

        $request = new Request('/');
    }

    public function testHandleWhenEnableMaintenanceMode()
    {

    }

    public function testHandleWhenDisableMaintenanceMode()
    {
        
    }
}