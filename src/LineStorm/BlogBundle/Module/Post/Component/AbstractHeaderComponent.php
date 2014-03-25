<?php

namespace LineStorm\BlogBundle\Module\Post\Component;


class AbstractHeaderComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_HEADER;
    }
} 
