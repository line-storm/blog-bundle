<?php

namespace LineStorm\CmsBundle\Module;

/**
 * Class AbstractModule
 * @package LineStorm\CmsBundle\Module
 */
abstract class AbstractModule implements ModuleInterface
{
    protected $name;
    protected $id;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getAssets()
    {
        return array();
    }

}
