<?php

namespace LineStorm\BlogBundle\Twig;

use LineStorm\BlogBundle\Module\ModuleManager;

class BlogAdminExtension extends \Twig_Extension
{
    /**
     * @var \LineStorm\BlogBundle\Module\ModuleManager
     */
    private $moduleManager;

    public function __construct(ModuleManager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('blog_admin_module_list', array($this, 'getModulesFunction')),
        );
    }

    public function getModulesFunction()
    {
        return $this->moduleManager->getModules();
    }

    public function getName()
    {
        return 'linestorm_blog_admin_extension';
    }
}
