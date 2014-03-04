<?php

namespace LineStorm\BlogBundle\Module;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Routing\RouteCollection;

class PostModule extends AbstractModule implements ModuleInterface
{
    private $name = 'Post';
    private $id = 'post';

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNavigation()
    {
        return array(
            'View All' => array('linestorm_blog_admin_module_post_list', array()),
            'New'      => array('linestorm_blog_admin_module_post_create', array()),
        );
    }

    public function getHome()
    {
        return 'linestorm_blog_admin_module_post';
    }

    public function addRoutes(LoaderInterface $loader)
    {
        return $loader->import('@LineStormBlogBundle/Resources/config/routing/modules/post.yml', 'yaml');
        $routes = new RouteCollection();
        $routes->addResource($resource);

        return $routes;
    }
} 
