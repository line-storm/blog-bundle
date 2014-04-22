<?php

namespace LineStorm\CmsBundle\Tests\Module;

use LineStorm\CmsBundle\Module\ModuleManager;
use LineStorm\CmsBundle\Tests\Fixtures\Module\TestModule;

/**
 * Module Manager Unit Tests
 *
 * Class ModuleTest
 *
 * @package LineStorm\CmsBundle\Tests\Module
 */
class ModuleManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the module manager
     */
    public function testGetModule()
    {
        $moduleManager = new ModuleManager();
        $moduleManager->addModule(new TestModule());

        $module = $moduleManager->getModule('test');

        $this->assertInstanceOf('\LineStorm\CmsBundle\Tests\Fixtures\Module\TestModule', $module);

    }

    /**
     * Test getting all the modules
     */
    public function testGetModules()
    {
        $moduleManager = new ModuleManager();
        $moduleManager->addModule(new TestModule());

        $modules = $moduleManager->getModules();

        $this->assertTrue(is_array($modules));
        $this->assertArrayHasKey('test', $modules);
    }
} 
