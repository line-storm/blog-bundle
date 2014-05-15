<?php

namespace LineStorm\CmsBundle\DependencyInjection\ContainerBuilder;

/**
 * Helper class to generate a Doctrine ORM mappings pass
 *
 * Class DoctrineOrmCompilerPass
 * @package LineStorm\CmsBundle\DependencyInjection\ContainerBuilder
 */
class DoctrineOrmCompilerPass
{

    /**
     * Generate a mappings pass from a mapping array
     *
     * @param $mappings
     *
     * @return mixed
     * @throws \Exception
     */
    static public function getMappingsPass($mappings)
    {
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

        $ormPass = $compilerPass::createXmlMappingDriver($mappings, $em, $flag);

        return $ormPass;
<<<<<<< HEAD
=======

>>>>>>> Added helper orm mappings pass
    }
}
