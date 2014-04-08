<?php

namespace LineStorm\CmsBundle\DependencyInjection;

use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\ModuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LineStormCmsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter("linestorm_cms.entity_config",        $config['entity_classes']);
        $container->setParameter("linestorm_cms.entity_manager",       $config['entity_manager']);
        $container->setParameter("linestorm_cms.backend_type_orm",     true);
    }
}
