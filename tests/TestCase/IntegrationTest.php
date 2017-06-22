<?php

namespace Lemon\CakePlugin\MaintenanceMode\Tests\TestCase;

use Cake\Core\Configure;
use Cake\Routing\DispatcherFactory;
use Cake\TestSuite\TestCase;
use Lemon\CakePlugin\MaintenanceMode\Routing\Filter\MaintenanceModeFilter;

class IntegrationTest extends TestCase
{
    /**
     * Test plugin is integraded
     */
    public function testPluginIntegration()
    {
        $config = Configure::read('maintenance_mode');

        $this->assertArrayHasKey('lockFile', $config);
        $this->assertArrayHasKey('viewClass', $config);
        $this->assertArrayHasKey('templatePath', $config);
        $this->assertArrayHasKey('templateFile', $config);
        $this->assertArrayHasKey('templateLayout', $config);
        $this->assertArrayHasKey('viewVars', $config);

        $filters = DispatcherFactory::filters();
        $hasFilter = false;
        foreach ($filters as $filter) {
            if ($filter instanceof MaintenanceModeFilter) {
                $hasFilter = true;
                break;
            }
        }

        $this->assertTrue($hasFilter);
    }
}
