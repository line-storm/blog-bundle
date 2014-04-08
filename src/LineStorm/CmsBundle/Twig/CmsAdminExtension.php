<?php

namespace LineStorm\CmsBundle\Twig;

use LineStorm\CmsBundle\Module\ModuleManager;

class CmsAdminExtension extends \Twig_Extension
{
    /**
     * @var \LineStorm\CmsBundle\Module\ModuleManager
     */
    private $moduleManager;

    public function __construct(ModuleManager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('cms_admin_module_list', array($this, 'getModulesFunction')),
        );
    }

    public function getModulesFunction()
    {
        return $this->moduleManager->getModules();
    }

    public function getName()
    {
        return 'linestorm_cms_admin_extension';
    }
}
