<?php

namespace LineStorm\CmsBundle\Router;

use LineStorm\CmsBundle\Module\ModuleManager;
use Symfony\Component\Config\Exception\FileLoaderLoadException;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class CmsLoader extends Loader implements LoaderInterface
{
    private $loaded = false;

    private $routes;

    private $resources = array();

    private $moduleManager;

    public function __construct(ModuleManager $moduleManager)
    {
        $this->routes = new RouteCollection();
        $this->moduleManager = $moduleManager;
    }

    public function addRoutes(array $routes)
    {
        $this->resources = array_merge_recursive($this->resources, $routes);
    }

    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "CMS" loader twice');
        }

        foreach($this->resources as $route)
        {
            $this->routes->addCollection($this->import($route));
        }

        $this->loaded = true;

        return $this->routes;
    }

    public function supports($resource, $type = null)
    {
        return 'linestorm_cms' === $type;
    }
}
