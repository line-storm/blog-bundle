<?php

namespace LineStorm\CmsBundle\Router;

use LineStorm\CmsBundle\Module\ModuleManager;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class CmsLoader extends Loader implements LoaderInterface
{
    private $loaded = false;

    private $routes;

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

        /*
         * TODO: make these dynamically loaded
         */
        $this->makeHomepageRoute();
        $this->makeCategoryRoutes();
        $this->makePostRoutes();
        $this->makeTagRoutes();

        $this->loaded = true;

        return $this->routes;
    }

    public function supports($resource, $type = null)
    {
        return 'linestorm_cms' === $type;
    }

    private function makeHomepageRoute()
    {
        // prepare a new route
        $pattern = '/blog';
        $defaults = array(
            '_controller' => 'LineStormPostBundle:Blog:index',
        );
        $requirements = array();
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_cms_index';
        $this->routes->add($routeName, $route);
    }

    private function makePostRoutes()
    {
        // prepare a new route
        $pattern = '/blog/{category}/{id}-{slug}';
        $defaults = array(
            '_controller' => 'LineStormPostBundle:Post:display',
        );
        $requirements = array(
            'category' => '[\w\d-]+',
            'path' => '\d+',
            'slug' => '[\w\d-]+'
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_cms_post';
        $this->routes->add($routeName, $route);
    }

    private function makeCategoryRoutes()
    {
        // prepare a new route
        $pattern = '/blog/{category}';
        $defaults = array(
            '_controller' => 'LineStormPostBundle:Category:display',
        );
        $requirements = array(
            'category' => '[\w\d-]+',
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_cms_category';
        $this->routes->add($routeName, $route);
    }

    private function makeTagRoutes()
    {
        // prepare a new route
        $pattern = '/blog/tag/{tag}';
        $defaults = array(
            '_controller' => 'LineStormPostBundle:Tag:display',
        );
        $requirements = array(
            'tag' => '[\w\d-]+',
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_cms_tag';
        $this->routes->add($routeName, $route);
    }
}
