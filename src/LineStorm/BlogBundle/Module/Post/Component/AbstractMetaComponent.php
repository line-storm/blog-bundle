<?php

namespace LineStorm\BlogBundle\Module\Post\Component;


class AbstractMetaComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_META;
    }
} 
