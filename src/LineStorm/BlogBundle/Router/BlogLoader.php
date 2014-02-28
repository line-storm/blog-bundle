<?php

namespace LineStorm\BlogBundle\Router;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class BlogLoader implements LoaderInterface
{
    private $loaded = false;

    private $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
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
        return 'linestorm_blog' === $type;
    }

    public function getResolver()
    {
        // needed, but can be blank, unless you want to load other resources
        // and if you do, using the Loader base class is easier (see below)
    }

    public function setResolver(LoaderResolverInterface $resolver)
    {
        // same as above
    }

    private function makeHomepageRoute()
    {
        // prepare a new route
        $pattern = '/';
        $defaults = array(
            '_controller' => 'LineStormBlogBundle:Blog:index',
        );
        $requirements = array();
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_blog_index';
        $this->routes->add($routeName, $route);
    }

    private function makePostRoutes()
    {
        // prepare a new route
        $pattern = '/{category}/{id}-{slug}';
        $defaults = array(
            '_controller' => 'LineStormBlogBundle:Post:display',
        );
        $requirements = array(
            'category' => '[\w\d-]+',
            'path' => '\d+',
            'slug' => '[\w\d-]+'
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_blog_post';
        $this->routes->add($routeName, $route);

        // prepare a new route
        $pattern = '/admin/post/new';
        $defaults = array(
            '_controller' => 'LineStormBlogBundle:Post:create',
        );
        $requirements = array();
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_blog_post_new';
        $this->routes->add($routeName, $route);
    }

    private function makeCategoryRoutes()
    {
        // prepare a new route
        $pattern = '/{category}/';
        $defaults = array(
            '_controller' => 'LineStormBlogBundle:Category:display',
        );
        $requirements = array(
            'category' => '[\w\d-]*',
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_blog_category';
        $this->routes->add($routeName, $route);
    }

    private function makeTagRoutes()
    {
        // prepare a new route
        $pattern = '/tag/{tag}';
        $defaults = array(
            '_controller' => 'LineStormBlogBundle:tag:display',
        );
        $requirements = array(
            'tag' => '[\w\d-]*',
        );
        $route = new Route($pattern, $defaults, $requirements, array(),'', array(), array('GET'));

        // add the new route to the route collection:
        $routeName = 'linestorm_blog_tag';
        $this->routes->add($routeName, $route);
    }
}
