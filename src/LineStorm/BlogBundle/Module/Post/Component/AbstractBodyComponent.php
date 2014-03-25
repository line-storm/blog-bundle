<?php

namespace LineStorm\BlogBundle\Module\Post\Component;


class AbstractBodyComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_BODY;
    }
} 
