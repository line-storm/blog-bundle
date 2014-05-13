<?php

namespace LineStorm\Content\Tests\Component;

use LineStorm\Content\Component\AbstractComponent;
use LineStorm\Content\Tests\Fixtures\Component\HeaderComponent;

/**
 * Test class for AbstractHeaderComponent
 *
 * Class AbstractHeaderComponentTest
 *
 * @package LineStorm\Content\Tests\Component
 */
class AbstractHeaderComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testComponentType()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');

        $component = new HeaderComponent($modelManager, $container);

        $this->assertEquals(AbstractComponent::TYPE_HEADER, $component->getType());
    }
}
