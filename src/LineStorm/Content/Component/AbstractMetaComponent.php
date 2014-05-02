<?php

namespace LineStorm\Content\Component;


class AbstractMetaComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_META;
    }
} 
