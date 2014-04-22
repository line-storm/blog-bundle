<?php

namespace LineStorm\CmsBundle\Tests\Module;

use LineStorm\CmsBundle\Tests\Fixtures\Module\TestModule;

/**
 * Module Unit Tests
 *
 * Class ModuleTest
 *
 * @package LineStorm\CmsBundle\Tests\Module
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the module creation
     */
    public function testModule()
    {
        $module = new TestModule();

        $this->assertInstanceOf('\LineStorm\CmsBundle\Module\ModuleInterface', $module);
    }

    public function testNavigation()
    {
        $module = new TestModule();

        $navigation = $module->getNavigation();

        $this->assertTrue(is_array($navigation), 'navigation must return an array');
        $this->assertTrue(count($navigation) > 0);

        $home = $module->getHome();
        $this->assertTrue(strlen($home) > 0, 'home must return a route');
    }

    public function testFrontendRoutes()
    {
        $module = new TestModule();

        $loader = $this->getMock('\Symfony\Component\Config\Loader\Loader', array(), array(), '', false);

        $routes = $module->addRoutes($loader);

        $this->assertInstanceOf('\Symfony\Component\Routing\RouteCollection', $routes);
    }

    public function testAdminRoutes()
    {
        $module = new TestModule();

        $loader = $this->getMock('\Symfony\Component\Config\Loader\Loader', array(), array(), '', false);

        $routes = $module->addAdminRoutes($loader);

        $this->assertInstanceOf('\Symfony\Component\Routing\RouteCollection', $routes);
    }
} 
