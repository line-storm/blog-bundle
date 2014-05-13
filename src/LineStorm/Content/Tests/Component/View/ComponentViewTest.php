<?php

namespace LineStorm\Content\Tests\Component\View;

use LineStorm\Content\Component\View\ComponentView;

/**
 * Test case for component view
 *
 * Class ComponentViewTest
 *
 * @package LineStorm\Content\Tests\Component\View
 */
class ComponentViewTest extends \PHPUnit_Framework_TestCase
{
    public function testOptions()
    {
        $options = array('opt1' => 'val1', 'opt2' => 'val2');
        $view = new ComponentView('test:template', $options);

        $objectOptions = $view->getOptions();
        $this->assertCount(2, $objectOptions);

        foreach($options as $k => $v)
        {
            $this->assertArrayHasKey($k, $objectOptions);
            $this->assertEquals($objectOptions[$k], $v);
        }
    }

    public function testTemplate()
    {
        $options = array('opt1' => 'val1', 'opt2' => 'val2');
        $template = 'test:template';
        $view = new ComponentView($template, $options);

        $objectTemplate = $view->getTemplate();

        $this->assertEquals($objectTemplate, $template);
    }
}
