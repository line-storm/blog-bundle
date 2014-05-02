<?php

namespace LineStorm\CmsBundle\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This Compiler Pass will inject all the content tagged components into a module
 *
 * Class ComponentCompilerPass
 *
 * @package LineStorm\CmsBundle\DependencyInjection\ContainerBuilder
 */
class ComponentCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $taggedModules    = $container->findTaggedServiceIds('linestorm.content.component_module');
        $taggedComponents = $container->findTaggedServiceIds('linestorm.content.component');

        if(!count($taggedModules) || !count($taggedComponents))
        {
            return;
        }

        $modelManagerRef = new Reference('linestorm.cms.model_manager');
        $containerRef    = new Reference('service_container');

        // setup the component contructor and build the component reference array
        $components = array();
        foreach($taggedComponents as $cId => $cAttributes)
        {
            $components[] = new Reference($cId);

            $componentDefinition = $container->getDefinition($cId);
            $componentDefinition->setArguments(array(
                $modelManagerRef, $containerRef
            ));
        }

        // inject the component reference array into each module
        foreach($taggedModules as $mId => $mAttributes)
        {
            $moduleDefinition = $container->getDefinition($mId);

            $moduleDefinition->addMethodCall(
                'setComponents',
                array($components)
            );
        }
    }
} 
