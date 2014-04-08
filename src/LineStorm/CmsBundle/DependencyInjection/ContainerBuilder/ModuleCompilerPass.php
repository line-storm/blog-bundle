<?php

namespace LineStorm\CmsBundle\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ModuleCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('linestorm.cms.module_manager')) {
            return;
        }

        $definition = $container->getDefinition(
            'linestorm.cms.module_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'linestorm.cms.module'
        );

        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addModule',
                array(new Reference($id))
            );
        }
    }
} 
