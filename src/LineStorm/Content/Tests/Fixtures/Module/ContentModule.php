<?php

namespace LineStorm\Content\Tests\Fixtures\Module;

use LineStorm\Content\Module\AbstractContentModule;
use Symfony\Component\Config\Loader\Loader;

/**
 * Example content module
 *
 * Class ContentModule
 *
 * @package LineStorm\Content\Tests\Fixtures\Module
 */
class ContentModule extends AbstractContentModule
{
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return 'test_content_module';
    }

    /**
     * Get the route of the homepage
     *
     * @return string
     */
    public function getHome()
    {
    }

    /**
     * Get an array of navigation links
     *
     * @return array
     */
    public function getNavigation()
    {
    }

    /**
     * Load the frontend routes
     *
     * @param Loader $loader
     *
     * @return mixed
     */
    public function addRoutes(Loader $loader)
    {
    }

    /**
     * Load the backend routes
     *
     * @param Loader $loader
     *
     * @return mixed
     */
    public function addAdminRoutes(Loader $loader)
    {
    }

} 
