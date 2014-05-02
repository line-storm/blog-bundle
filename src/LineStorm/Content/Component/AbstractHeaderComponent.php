<?php

namespace LineStorm\Content\Component;


class AbstractHeaderComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_HEADER;
    }
} 
