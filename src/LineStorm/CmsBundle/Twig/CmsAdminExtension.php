<?php

namespace LineStorm\CmsBundle\Twig;

use Assetic\Factory\AssetFactory;
use Assetic\Factory\LazyAssetManager;
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
     * @var AssetFactory
     */
    private $assetFactory;

    /**
     * @param ModuleManager    $moduleManager
     * @param AssetFactory $assetFactory
     */
    public function __construct(ModuleManager $moduleManager, AssetFactory $assetFactory)
    {
        $this->moduleManager = $moduleManager;
        $this->assetFactory  = $assetFactory;
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('cms_admin_module_list', array($this, 'getModulesFunction')),
            new \Twig_SimpleFunction('require', array($this, 'getRequireAsset'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('linestorm_module_assets', array($this, 'getLinestormAssets'), array('is_safe' => array('html'))),
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

    public function getLinestormAssets()
    {
        $modules = $this->moduleManager->getModules();

        $inputs = array();
        foreach($modules as $module)
        {
            foreach($module->getAssets() as $asset)
            {
                $inputs[] = $asset;
            }
        }

        $filters = array('compass');
        $attributes = array(
            'output' => 'test.css'
        );
        $attributes['name'] = $this->assetFactory->generateAssetName($inputs, $filters, $attributes);

        $asset = $this->assetFactory->createAsset($inputs, $filters, $attributes);

        $asset->load();
        var_dump($asset->dump());
        die();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'linestorm_cms_admin_extension';
    }
}
