<?php

namespace LineStorm\Content\Module;

use LineStorm\CmsBundle\Module\AbstractModule;
use LineStorm\CmsBundle\Module\ModuleInterface;
use LineStorm\Content\Component\AbstractComponent;
use LineStorm\Content\Component\ComponentInterface;

/**
 * This abstract provides access to components
 *
 * Class AbstractContentModule
 *
 * @package LineStorm\Content\Module
 */
abstract class AbstractContentModule extends AbstractModule implements ModuleInterface
{
    /**
     * @var ComponentInterface[]
     */
    protected $components = array();

    /**
     * @param $componentId
     * @return $this
     */
    public function removeComponent($componentId)
    {
        unset($this->components[$componentId]);

        return $this;
    }

    /**
     * @param $componentId
     * @return ComponentInterface
     */
    public function getComponent($componentId)
    {
        if (array_key_exists($componentId, $this->components))
            return $this->components[$componentId];
        else
            return null;
    }

    /**
     * @param null $type
     * @return ComponentInterface[]
     */
    public function getComponents($type=null)
    {
        if($type === null)
        {
            return $this->components;
        }
        else
        {
            $components = array();
            foreach($this->components as $component)
            {
                if($component->getType() === AbstractComponent::strToType($type))
                {
                    $components[] = $component;
                }
            }

            return $components;
        }
    }

    /**
     * @param array $components
     * @return $this
     */
    public function setComponents(array $components)
    {
        foreach ($components as $component) {
            $this->addComponent($component);
        }

        return $this;
    }

    /**
     * @param ComponentInterface $component
     * @return $this
     */
    public function addComponent(ComponentInterface $component)
    {
        $this->components[$component->getId()] = $component;

        return $this;
    }

    /**
     * @return array
     */
    public function getComponentAssets()
    {
        $assets = array();
        foreach ($this->components as $component) {
            $assets = array_merge_recursive($assets, $component->getAssets());
        }

        return $assets;
    }

    /**
     * @return array
     */
    public function getComponentViewAssets()
    {
        $assets = array();
        foreach ($this->components as $component) {
            $assets = array_merge_recursive($assets, $component->getViewAssets());
        }

        return $assets;
    }
} 
