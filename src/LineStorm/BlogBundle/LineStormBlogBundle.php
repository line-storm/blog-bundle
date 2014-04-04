<?php

namespace LineStorm\BlogBundle;

use LineStorm\BlogBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use LineStorm\BlogBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass as LocalDoctrineOrmMappingsPass;
use LineStorm\BlogBundle\DependencyInjection\ContainerBuilder\MediaCompilerPass;
use LineStorm\BlogBundle\DependencyInjection\ContainerBuilder\ModuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LineStormBlogBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ModuleCompilerPass());

    }
}
