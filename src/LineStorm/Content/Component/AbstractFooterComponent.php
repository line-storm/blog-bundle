<?php

namespace LineStorm\Content\Component;

/**
 * Helper class for footers components
 *
 * Class AbstractFooterComponent
 *
 * @package LineStorm\Content\Component
 */
abstract class AbstractFooterComponent extends AbstractComponent implements ComponentInterface
{
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this::TYPE_FOOTER;
    }
} 
