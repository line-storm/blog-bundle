<?php

namespace LineStorm\Content\Component;

/**
 * Class AbstractBodyComponent
 * @package LineStorm\Content\Component
 */
abstract class AbstractBodyComponent extends AbstractComponent implements ComponentInterface
{
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this::TYPE_BODY;
    }
} 
