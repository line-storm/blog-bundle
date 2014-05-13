<?php

namespace LineStorm\Content\Tests\Component;

use LineStorm\Content\Component\AbstractComponent;
use LineStorm\Content\Tests\Fixtures\Component\FooterComponent;

/**
 * Test class for AbstractFooterComponent
 *
 * Class AbstractFooterComponentTest
 *
 * @package LineStorm\Content\Tests\Component
 */
class AbstractFooterComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testComponentType()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');

        $component = new FooterComponent($modelManager, $container);

        $this->assertEquals(AbstractComponent::TYPE_FOOTER, $component->getType());
    }
}
