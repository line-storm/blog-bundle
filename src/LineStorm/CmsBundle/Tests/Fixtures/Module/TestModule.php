<?php

namespace LineStorm\CmsBundle\Tests\Fixtures\Module;

use LineStorm\CmsBundle\Module\AbstractModule;
use LineStorm\CmsBundle\Module\ModuleInterface;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Test module class
 *
 * Class TestModule
 *
 * @package LineStorm\CmsBundle\Tests\Fixtures\Module
 */
class TestModule extends AbstractModule implements ModuleInterface
{

    protected $name = 'Test';
    protected $id = 'test';

    /**
     * Returns the navigation array
     *
     * @return array
     */
    public function getNavigation()
    {
        return array(
            'View All' => array('linestorm_cms_module_test_list', array()),
            'New' => array('linestorm_cms_module_test_create', array()),
        );
    }

    /**
     * Thr route to load as 'home'
     *
     * @return string
     */
    public function getHome()
    {
        return 'linestorm_cms_module_test_list';
    }

    /**
     * Add routes to the router
     * @param Loader $loader
     * @return RouteCollection
     */
    public function addRoutes(Loader $loader)
    {
        $collection = new RouteCollection();

        $route = new Route('/_test/route');
        $collection->add('test_route', $route);

        return $collection;
    }

    /**
     * Add routes to the router
     * @param Loader $loader
     * @return RouteCollection
     */
    public function addAdminRoutes(Loader $loader)
    {
        $collection = new RouteCollection();

        $route = new Route('/_test/admin/route');
        $collection->add('admin_test_route', $route);

        return $collection;
    }
} 
