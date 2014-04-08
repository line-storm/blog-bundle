<?php

namespace LineStorm\CmsBundle\Form;

use LineStorm\CmsBundle\Model\ModelManager;
use LineStorm\CmsBundle\Module\ModuleManager;
use Symfony\Component\Form\AbstractType;

abstract class AbstractCmsFormType extends AbstractType
{
    /**
     * ModelManager
     *
     * @var ModelManager
     */
    protected $modelManager;

    /**
     * ModuleManager
     *
     * @var ModuleManager
     */
    protected $moduleManager;

    function __construct(ModelManager $modelManager, ModuleManager $moduleManager = null)
    {
        $this->modelManager = $modelManager;
        $this->moduleManager = $moduleManager;
    }

} 
