<?php

namespace LineStorm\CmsBundle\Twig;

use LineStorm\CmsBundle\Module\ModuleManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Kernel;

class CmsAdminExtension extends \Twig_Extension
{
    /**
     * @var \LineStorm\CmsBundle\Module\ModuleManager
     */
    private $moduleManager;

    /**
     * @var Container
     */
    private $container;

    public function __construct(ModuleManager $moduleManager, $container)
    {
        $this->moduleManager = $moduleManager;
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('cms_admin_module_list', array($this, 'getModulesFunction')),
            new \Twig_SimpleFunction('require', array($this, 'getRequireAsset'), array('is_safe' => array('html'))),
        );
    }

    public function getModulesFunction()
    {
        return $this->moduleManager->getModules();
    }

    public function getRequireAsset($name)
    {
        if(strpos($name, '@') === 0)
        {
            // split it up
            if(preg_match('/^\@([a-zA-Z0-9]+)Bundle\/Resources\/public\/js\/(.+).js$/', $name, $matches))
            {
                $bundle = strtolower($matches[1]);
                $module = $matches[2];
                return "'cms_{$module}'";
            }
            else
            {
                throw new \Exception("Unknown requirejs module '{$name}'");
            }
        }
        else
        {
            return "'{$name}'";
        }
    }

    public function getName()
    {
        return 'linestorm_cms_admin_extension';
    }
}
