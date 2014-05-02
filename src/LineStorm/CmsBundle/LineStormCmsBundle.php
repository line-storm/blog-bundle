<?php

namespace LineStorm\CmsBundle;

use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\ComponentCompilerPass;
use LineStorm\CmsBundle\DependencyInjection\ContainerBuilder\ModuleCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class LineStormCmsBundle
 * @package LineStorm\CmsBundle
 */
class LineStormCmsBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // add module pass
        $container->addCompilerPass(new ModuleCompilerPass());
        $container->addCompilerPass(new ComponentCompilerPass());
    }
}
