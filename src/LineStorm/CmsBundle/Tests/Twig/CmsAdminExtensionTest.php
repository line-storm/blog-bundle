<?php

namespace LineStorm\CmsBundle\Tests\Twig;
use LineStorm\CmsBundle\Module\ModuleManager;
use LineStorm\CmsBundle\Tests\Fixtures\Module\TestModule;
use LineStorm\CmsBundle\Twig\CmsAdminExtension;

/**
 * Unit test for twig extension
 *
 * Class CmsAdminExtensionTest
 *
 * @package LineStorm\CmsBundle\Tests\Twig
 */
class CmsAdminExtensionTest extends \PHPUnit_Framework_TestCase
{
    private function createExtension()
    {
        $moduleManager = new ModuleManager();
        $moduleManager->addModule(new TestModule());

        return new CmsAdminExtension($moduleManager);
    }


    public function testFunctions()
    {
        $ext = $this->createExtension();
        $functions = $ext->getFunctions();

        $this->assertTrue(is_array($functions));

        foreach($functions as $function)
        {
            $this->assertInstanceOf('\Twig_SimpleFunction', $function);
        }
    }

    public function testGetModules()
    {
        $ext = $this->createExtension();
        $modules = $ext->getModulesFunction();

        $this->assertTrue(is_array($modules));

        foreach($modules as $module)
        {
            $this->assertInstanceOf('\LineStorm\CmsBundle\Module\ModuleInterface', $module);
        }

    }

    public function testRequireAsset()
    {
        $ext = $this->createExtension();
        $asset = $ext->getRequireAsset('@TestBundle/Resources/public/js/testing.js');

        $this->assertEquals("'cms_testing'", $asset);
    }

} 
