<?php

namespace LineStorm\CmsBundle\Twig;

use LineStorm\CmsBundle\Module\ModuleManager;

/**
 * Twig extension functions
 *
 * Class CmsAdminExtension
 *
 * @package LineStorm\CmsBundle\Twig
 */
class CmsAdminExtension extends \Twig_Extension
{
    /**
     * @var \LineStorm\CmsBundle\Module\ModuleManager
     */
    private $moduleManager;

    /**
     * @param ModuleManager $moduleManager
     */
    public function __construct(ModuleManager $moduleManager)
    {
        $this->moduleManager = $moduleManager;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('cms_admin_module_list', array($this, 'getModulesFunction')),
            new \Twig_SimpleFunction('require', array($this, 'getRequireAsset'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Return all the modules
     *
     * @return \LineStorm\CmsBundle\Module\ModuleInterface[]
     */
    public function getModulesFunction()
    {
        return $this->moduleManager->getModules();
    }

    /**
     * Convert an asset URL into a requirejs bundle
     *
     * @param $name
     *
     * @return string
     * @throws \Exception
     */
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

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'linestorm_cms_admin_extension';
    }
}
