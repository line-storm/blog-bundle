<?php

namespace LineStorm\Content\Tests\Component;

use LineStorm\Content\Component\AbstractComponent;
use LineStorm\Content\Tests\Fixtures\Component\MetaComponent;

/**
 * Test class for AbstractMetaComponent
 *
 * Class AbstractMetaComponentTest
 *
 * @package LineStorm\Content\Tests\Component
 */
class AbstractMetaComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testComponentType()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');

        $component = new MetaComponent($modelManager, $container);

        $this->assertEquals(AbstractComponent::TYPE_META, $component->getType());
    }
}
