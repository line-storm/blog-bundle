<?php

namespace LineStorm\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('line_storm_blog');

        $rootNode
            ->isRequired()
            ->children()
                ->scalarNode('entity_manager')->isRequired()->end()
                ->arrayNode('entity_classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('post')->defaultValue('LineStorm\BlogBundle\Entity\Post')->end()
                        ->scalarNode('tag')->defaultValue('LineStorm\BlogBundle\Entity\Tag')->end()
                        ->scalarNode('category')->defaultValue('LineStorm\BlogBundle\Entity\Category')->end()
                        ->scalarNode('user')->defaultValue('LineStorm\BlogBundle\Entity\User')->end()
                        ->scalarNode('user_group')->defaultValue('LineStorm\BlogBundle\Entity\UserGroup')->end()
                    ->end()
                ->end()
                ->arrayNode('pages')
                    ->prototype('array')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('controller')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('controller')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
