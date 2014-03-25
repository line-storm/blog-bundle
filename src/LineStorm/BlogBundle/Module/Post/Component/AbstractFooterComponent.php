<?php

namespace LineStorm\BlogBundle\Module\Post\Component;


class AbstractFooterComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_FOOTER;
    }
} 
