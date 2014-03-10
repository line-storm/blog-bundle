<?php

namespace LineStorm\BlogBundle\Form;


use LineStorm\BlogBundle\Model\ModelManager;
use Symfony\Component\Form\AbstractType;

abstract class AbstractBlogFormType extends AbstractType
{

    protected $modelManager;

    function __construct(ModelManager $modelManager)
    {
        $this->modelManager = $modelManager;
    }

} 
