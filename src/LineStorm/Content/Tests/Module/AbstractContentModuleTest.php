<?php

namespace LineStorm\Content\Tests\Module;

use LineStorm\Content\Tests\Fixtures\Component\BodyComponent;
use LineStorm\Content\Tests\Fixtures\Component\HeaderComponent;
use LineStorm\Content\Tests\Fixtures\Module\ContentModule;

/**
 * Unit tests for Content Module
 *
 * Class AbstractContentModuleTest
 *
 * @package LineStorm\Content\Tests\Module
 */
class AbstractContentModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ContentModule
     */
    private function getModule()
    {
        return new ContentModule();
    }

    /**
     * @return BodyComponent
     */
    private function getBodyComponent()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');
        $component = new BodyComponent($modelManager, $container);

        return $component;
    }

    /**
     * @return HeaderComponent
     */
    private function getHeadComponent()
    {
        $modelManager = $this->getMock('\LineStorm\CmsBundle\Model\ModelManager');
        $container = $this->getMock('\Symfony\Component\DependencyInjection\Container');
        $component = new HeaderComponent($modelManager, $container);

        return $component;
    }

    public function testAddGetComponent()
    {
        $module = $this->getModule();

        $component = $this->getBodyComponent();
        $module->addComponent($component);

        $this->assertEquals($module->getComponent($component->getId()), $component);
    }

    public function testAddRemoveComponent()
    {
        $module = $this->getModule();

        $component = $this->getBodyComponent();
        $module->addComponent($component);

        $this->assertEquals($module->getComponent($component->getId()), $component);

        $module->removeComponent($component->getId());
        $this->assertNull($module->getComponent($component->getId()));
    }

    public function testSetGetAllComponents()
    {
        $module = $this->getModule();

        $componentBody = $this->getBodyComponent();
        $componentHead = $this->getHeadComponent();

        $module->setComponents(array(
            $componentBody, $componentHead
        ));

        $components = $module->getComponents();

        $this->assertCount(2, $components);
        $this->assertArrayHasKey($componentBody->getId(), $components);
        $this->assertArrayHasKey($componentHead->getId(), $components);
    }

    public function testGetComponentAssets()
    {
        $module = $this->getModule();

        $component = $this->getBodyComponent();
        $module->addComponent($component);

        $assets = $module->getComponentAssets();

        $this->assertTrue(is_array($assets));
        $this->assertCount(2, $assets);
    }

    public function testGetDefaultComponentAssets()
    {
        $module = $this->getModule();

        $component = $this->getHeadComponent();
        $module->addComponent($component);

        $assets = $module->getComponentAssets();

        $this->assertTrue(is_array($assets));
        $this->assertCount(0, $assets);
    }

}
