<?php
/**
 * Created by PhpStorm.
 * User: athorne1016
 * Date: 03/03/14
 * Time: 12:27
 */

namespace LineStorm\BlogBundle\Module;

/**
 * Class ModuleManager
 * @package LineStorm\BlogBundle\Module
 */
class ModuleManager
{

    /**
     * @var ModuleInterface[]
     */
    private $modules = array();

    /**
     * Add a module
     *
     * @param ModuleInterface $module
     */
    public function addModule(ModuleInterface $module)
    {
        $this->modules[$module->getId()] = $module;
    }

    /**
     * @param $module
     * @return ModuleInterface
     */
    public function getModule($module)
    {
        return $this->modules[$module];
    }


    /**
     * @return ModuleInterface[]
     */
    public function getModules()
    {
        return $this->modules;
    }

} 