<?php

namespace LineStorm\Content\Component;


class AbstractFooterComponent extends AbstractComponent
{
    public function getType()
    {
        return $this::TYPE_FOOTER;
    }
} 
