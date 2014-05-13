<?php

namespace LineStorm\Content\Component;

/**
 * Helper class for meta components
 *
 * Class AbstractMetaComponent
 *
 * @package LineStorm\Content\Component
 */
abstract class AbstractMetaComponent extends AbstractComponent implements ComponentInterface
{
    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this::TYPE_META;
    }
}
