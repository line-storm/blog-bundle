<?php

/*
 * This file is part of the Doctrine Bundle
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 * (c) Doctrine Project, Benjamin Eberlei <kontakt@beberlei.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LineStorm\CmsBundle\DependencyInjection\Compiler;

use Symfony\Bridge\Doctrine\DependencyInjection\CompilerPass\RegisterMappingsPass;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class for Symfony bundles to configure mappings for model classes not in the
 * automapped folder.
 *
 * @author David Buchmann <david@liip.ch>
 */
class DoctrineOrmMappingsPass extends RegisterMappingsPass
{
    /**
     * You should not directly instantiate this class but use one of the
     * factory methods.
     *
     * @param Definition|Reference $driver            the driver to use
     * @param array                $namespaces        list of namespaces this driver should handle.
     * @param string[]             $managerParameters ordered list of container parameters that may
     *      provide the name of the manager to register the mappings for. The first non-empty name
     *      is used, the others skipped.
     * @param bool                 $enabledParameter  if specified, the compiler pass only executes
     *      if this parameter exists in the service container.
     */
    public function __construct($driver, $namespaces, array $managerParameters, $enabledParameter = false)
    {
        $managerParameters[] = 'doctrine.default_entity_manager';
        parent::__construct(
            $driver,
            $namespaces,
            $managerParameters,
            'doctrine.orm.%s_metadata_driver',
            $enabledParameter
        );

    }

    /**
     * @param array       $mappings          Hashmap of directory path to namespace
     * @param string[]    $managerParameters List of parameters that could which object manager name
     *                                       your bundle uses. This compiler pass will automatically
     *                                       append the parameter name for the default entity manager
     *                                       to this list.
     * @param bool|string $enabledParameter  Service container parameter that must be present to
     *                                       enable the mapping. Set to false to not do any check,
     *                                       optional.
     *
     * @return \LineStorm\CmsBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass
     */
    public static function createXmlMappingDriver(array $mappings, array $managerParameters = array(), $enabledParameter = false)
    {
        $arguments = array($mappings, '.orm.xml');
        $locator = new Definition('Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator', $arguments);
        $driver = new Definition('Doctrine\ORM\Mapping\Driver\XmlDriver', array($locator));

        return new DoctrineOrmMappingsPass($driver, $mappings, $managerParameters, $enabledParameter);
    }
}
