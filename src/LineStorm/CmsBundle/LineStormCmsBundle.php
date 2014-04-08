<?php

namespace LineStorm\CmsBundle;

use LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass as LocalDoctrineOrmMappingsPass;
use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\MediaCompilerPass;
use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\ModuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LineStormCmsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ModuleCompilerPass());

    }
}
