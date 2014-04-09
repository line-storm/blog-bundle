<?php

namespace LineStorm\CmsBundle\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ModuleCompilerPass
 * @package LineStorm\CmsBundle\DependencyInjection\ContainerBuilder
 */
class ModuleCompilerPass implements CompilerPassInterface
{

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

        $compilerPass          = null;
        $ormCompilerClass      = 'Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';
        $localOrmCompilerClass = 'LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass';

        $em   = array('linestorm_cms.entity_manager');
        $flag = 'linestorm_cms.backend_type_orm';

        if(class_exists($ormCompilerClass))
        {
            $compilerPass = $ormCompilerClass;
        }
        elseif(class_exists($localOrmCompilerClass))
        {
            $compilerPass = $localOrmCompilerClass;
        }
        else
        {
            throw new \Exception("Unable to find ORM mapper");
        }

        $definition = $container->getDefinition('linestorm.cms.module_manager');

        $taggedServices = $container->findTaggedServiceIds('linestorm.cms.module');

        foreach($taggedServices as $id => $attributes)
        {
            $definition->addMethodCall('addModule', array(new Reference($id)));

            // add orm mappings
            $modelDir = realpath(__DIR__ . '/Resources/config/model/doctrine');
            $mappings = array(
                $modelDir => 'LineStorm\MediaBundle\Model',
            );
            $ormPass = $compilerPass::createXmlMappingDriver($mappings, $em, $flag);
            $container->addCompilerPass($ormPass);
        }

    }
} 
