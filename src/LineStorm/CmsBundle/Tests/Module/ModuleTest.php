<?php

namespace LineStorm\CmsBundle\Tests\Module;

use LineStorm\CmsBundle\Module\ModuleInterface;
use LineStorm\CmsBundle\Tests\Fixtures\Module\TestModule;
use Symfony\Component\Routing\RouteCollection;

/**
 * Module Unit Tests
 *
 * Class ModuleTest
 *
 * @package LineStorm\CmsBundle\Tests\Module
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    protected $id = 'test';
    protected $name = 'Test';

    /**
     * @return ModuleInterface
     */
    protected function getModule()
    {
        return new TestModule();
    }

    public function testId()
    {
        $module = $this->getModule();

        $id = $module->getId();
        $this->assertEquals($id, $this->id);
    }

    public function testName()
    {
        $module = $this->getModule();

        $name = $module->getName();
        $this->assertEquals($name, $this->name);
    }

    /**
     * Test the module creation
     */
    public function testModule()
    {
        $module = $this->getModule();

        $this->assertInstanceOf('\LineStorm\CmsBundle\Module\ModuleInterface', $module);
    }

    public function testNavigation()
    {
        $module = $this->getModule();

        $navigation = $module->getNavigation();

        $this->assertTrue(is_array($navigation), 'navigation must return an array');
        $this->assertTrue(count($navigation) > 0);

        $home = $module->getHome();
        $this->assertTrue(strlen($home) > 0, 'home must return a route');
    }

    public function testFrontendRoutes()
    {
        $module = $this->getModule();

        $loader = $this->getMock('\Symfony\Component\Config\Loader\Loader', array(), array(), '', false);

        $routes = $module->addRoutes($loader);

        $this->assertTrue($routes instanceof RouteCollection || $routes === null);
    }

    public function testAdminRoutes()
    {
        $module = $this->getModule();

        $loader = $this->getMock('\Symfony\Component\Config\Loader\Loader', array(), array(), '', false);

        $routes = $module->addAdminRoutes($loader);

        $this->assertTrue($routes instanceof RouteCollection || $routes === null);
    }
} 
