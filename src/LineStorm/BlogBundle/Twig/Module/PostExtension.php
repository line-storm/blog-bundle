<?php

namespace LineStorm\BlogBundle\Twig\Module;

use LineStorm\BlogBundle\Module\ModuleManager;
use LineStorm\BlogBundle\Module\Post\Component\ComponentInterface;
use Symfony\Component\DependencyInjection\Container;

class PostExtension extends \Twig_Extension
{
    /**
     * @var ModuleManager
     */
    private $moduleManager;

    /**
     * @var Container
     */
    private $container;

    public function __construct(ModuleManager $moduleManager, Container $container)
    {
        $this->container = $container;
        $this->moduleManager = $moduleManager;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('render_post_component_new', array($this, 'renderPostComponentNew'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('render_post_component_edit', array($this, 'renderPostComponentEdit'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('render_post_component_view', array($this, 'renderPostComponentView'), array('is_safe' => array('html'))),
        );
    }

    public function renderPostComponentNew(ComponentInterface $component)
    {
        // we need to pass in templating here or we get cyclic references :(
        $component->setTemplateEngine($this->container->get('templating'));
        return $component->getNewTemplate();
    }

    public function renderPostComponentEdit(ComponentInterface $component, $entities)
    {
        // we need to pass in templating here or we get cyclic references :(
        $component->setTemplateEngine($this->container->get('templating'));
        return $component->getEditTemplate($entities);
    }

    public function renderPostComponentView(ComponentInterface $component, $entities)
    {
        // we need to pass in templating here or we get cyclic references :(
        $component->setTemplateEngine($this->container->get('templating'));
        return $component->getViewTemplate($entities);
    }

    public function getName()
    {
        return 'linestorm_blog_module_post_extension';
    }
}
