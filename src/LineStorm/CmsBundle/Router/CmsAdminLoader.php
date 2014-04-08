<?php

namespace LineStorm\CmsBundle\Router;

use LineStorm\CmsBundle\Module\ModuleManager;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class CmsAdminLoader extends Loader implements LoaderInterface
{
    private $loaded = false;

    private $routes;

    /**
     * @var ModuleManager
     */
    private $moduleManager;

    public function __construct(ModuleManager $moduleManager)
    {
        $this->routes = new RouteCollection();
        $this->moduleManager = $moduleManager;
    }

    public function load($resource, $type = null)
    {

        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "app" loader twice');
        }

        $this->makeHomepageRoute();
        $this->makeModuleRoute();

        $this->loaded = true;

        return $this->routes;
    }

    public function supports($resource, $type = null)
    {
        return 'linestorm_cms_admin' === $type;
    }

    private function makeHomepageRoute()
    {
        // prepare a new route
        $pattern = '/dashboard';
        $defaults = array(
            '_controller' => 'LineStormCmsBundle:Admin:index',
        );
        $requirements = array();
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_cms_admin_index';
        $this->routes->add($routeName, $route);
    }

    private function makeModuleRoute()
    {
        foreach($this->moduleManager->getModules() as $module)
        {
            $routes = $module->addRoutes($this, $this->routes);
            $requirements = array();
            $routes->addPrefix('/module/'.$module->getId(), array(), $requirements);
            $this->routes->addCollection($routes);
        }
    }
}
