<?php

namespace Lemon\CakePlugin\MaintenanceMode\Tests\TestCase\Shell;

use Cake\Core\Configure;
use Cake\Console\ConsoleIo;
use Cake\TestSuite\TestCase;
use Cake\TestSuite\Stub\ConsoleOutput;
use Lemon\CakePlugin\MaintenanceMode\Shell\DownShell;

class DownShellTest extends TestCase
{
    /**
     * @var ConsoleIo
     */
    protected $io;

    /**
     * @var ConsoleOutput
     */
    protected $out;

    /**
     * @var DownShell|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $shell;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->out = new ConsoleOutput();
        $this->io = new ConsoleIo($this->out);

        $this->shell = $this->getMockBuilder(DownShell::class)
            ->setMethods(['in', '_stop'])
            ->setConstructorArgs([$this->io])
            ->getMock()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        parent::tearDown();

        unset($this->shell, $this->io, $this->out);
    }

    /**
     * Test method `getOptionParser()`
     */
    public function testGetOptionParser()
    {
        $this->shell->loadTasks();
        $parser = $this->shell->getOptionParser();

        $commands = $parser->subcommands();
        $options = $parser->options();
        $arguments = $parser->arguments();

        $this->assertSame([], $commands);
        $this->assertSame([], $arguments);
        $this->assertArrayHasKey('force', $options);
    }

    /**
     * Test method `main()`
     */
    public function testMain()
    {
        $this->shell->main();
    }
}
