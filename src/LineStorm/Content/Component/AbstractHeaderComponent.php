<?php

namespace LineStorm\Content\Component;

/**
 * Helper class for header components
 *
 * Class AbstractHeaderComponent
 *
 * @package LineStorm\Content\Component
 */
abstract class AbstractHeaderComponent extends AbstractComponent implements ComponentInterface
{
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this::TYPE_HEADER;
    }
} 
