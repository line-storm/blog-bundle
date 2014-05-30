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

        foreach($this->moduleManager->getModules() as $module)
        {
            $routes = $module->addAdminRoutes($this, $this->routes);

            if($routes)
            {
                $requirements = array();
                $routes->addPrefix('/module/'.$module->getId(), array(), $requirements);
                $this->routes->addCollection($routes);
            }
        }

        $this->loaded = true;

        return $this->routes;
    }

    public function supports($resource, $type = null)
    {
        return 'linestorm_cms_admin' === $type;
    }
}
