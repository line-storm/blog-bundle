<?php

namespace LineStorm\Content\Tests\Component;

use LineStorm\Content\Component\AbstractComponent;
use LineStorm\Content\Tests\Fixtures\Component\BodyComponent;

/**
 * Test class for AbstractBodyComponent
 *
 * Class AbstractBodyComponentTest
 *
 * @package LineStorm\Content\Tests\Component
 */
class AbstractBodyComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testComponentType()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');

        $component = new BodyComponent($modelManager, $container);

        $this->assertEquals(AbstractComponent::TYPE_BODY, $component->getType());
    }
}
