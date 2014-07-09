<?php

namespace LineStorm\CmsBundle\DependencyInjection\ContainerBuilder;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Yaml\Parser;

/**
 * Class ModuleBuilderCompilerPass
 * @package LineStorm\CmsBundle\DependencyInjection\ContainerBuilder
 */
class ModuleBuilderCompilerPass implements CompilerPassInterface
{

    /**
     * @var Bundle
     */
    private $bundle;

    /**
     * @param Bundle $bundle
     */
    function __construct(Bundle $bundle)
    {
        $this->bundle = $bundle;
    }


    /**
     * Process the compiler pass
     *
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function process(ContainerBuilder $container)
    {
        if(!$container->hasDefinition('linestorm.cms.module_manager'))
        {
            return;
        }

        $moduleManagerDefinition = $container->getDefinition('linestorm.cms.module_manager');

        $yamlParser = new Parser();
        $moduleConfig = $this->bundle->getPath() .'/Resources/config/module.yml';
        $config = $yamlParser->parse(file_get_contents($moduleConfig));

        if(is_array($config) && array_key_exists('module', $config))
        {
            $module = $config['module'];
            $moduleName = $module['name'];
            //$moduleManagerDefinition->addMethodCall('registerModule', array($config);

            // frontend routes
            if(array_key_exists('frontend', $module))
            {
                $router = $container->getDefinition('linestorm.cms.routing_loader');
                $router->addMethodCall('addRoutes', array($module['frontend']['routes']));
            }

            // backend routes
            if(array_key_exists('backend', $module))
            {
                $router = $container->getDefinition('linestorm.cms.admin.routing_loader');
                $router->addMethodCall('addRoutes', array($module['backend']['routes'], $moduleName));
            }

            // register assets
            $jsAssets = @glob($this->bundle->getPath().'/Resources/assets/frontend/js/*.js');
            if(count($jsAssets))
            {
                // register the asset service
                $assetCollectionDefinition = $container->register('linestorm.cms.module_assets.'.$moduleName, 'Assetic\Asset\AssetCollection');
                $assetCollectionDefinition->addMethodCall('setTargetPath', array('/js/'));

                $assetManagerDefinition = $container->getDefinition('assetic.asset_manager');

                $assetPath = '@'.$this->bundle->getName().'/Resources/assets/frontend/js/*.js';
                $assetManagerDefinition->addMethodCall('setFormula', array('cms_module_'.$moduleName, array(
                    $assetPath,
                    array(),
                    array(
                        'output' => '/js/cms_module_'.$moduleName.'.js'
                    ),
                )));
                //$assetManagerDefinition->addMethodCall('setFormula', array('cms_module_'.$moduleName, new Reference('linestorm.cms.module_assets.'.$moduleName)));

            }

        }
    }
} 
