<?php

namespace LineStorm\BlogBundle\DependencyInjection;

use LineStorm\BlogBundle\DependencyInjection\ContainerBuilder\ModuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LineStormBlogExtension extends Extension
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

        $xmlLoader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter("linestorm_blog.entity_config",        $config['entity_classes']);
        $container->setParameter("linestorm_blog.entity_manager",       $config['entity_manager']);

        if(($config['backend_type'] === 'orm' || $config['backend_type'] === null))
        {
            $container->setParameter("linestorm_blog.backend_type_orm",     true);
            $xmlLoader->load('orm.xml');

            $container->getDefinition('linestorm.blog.model.post.listener')->addTag('doctrine.event_subscriber');
            $container->getDefinition('linestorm.blog.model.tag.listener')->addTag('doctrine.event_subscriber');
        }
    }
}
