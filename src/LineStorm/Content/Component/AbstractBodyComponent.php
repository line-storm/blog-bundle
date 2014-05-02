<?php

namespace LineStorm\Content\Component;

/**
 * Class AbstractBodyComponent
 * @package LineStorm\Content\Component
 */
class AbstractBodyComponent extends AbstractComponent
{
    /**
     * Returns the body type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this::TYPE_BODY;
    }
} 
