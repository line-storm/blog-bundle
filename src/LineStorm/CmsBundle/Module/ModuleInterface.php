<?php

namespace LineStorm\CmsBundle\Module;

use Symfony\Component\Config\Loader\Loader;

/**
 * Interface ModuleInterface
 * @package LineStorm\CmsBundle\Module
 */
interface ModuleInterface {

    /**
     * Get the module id
     *
     * @return string
     */
    public function getId();

    /**
     * Get the module entity property name
     *
     * @return string
     */
    public function getName();

    /**
     * Get the route of the homepage
     *
     * @return string
     */
    public function getHome();

    /**
     * Get an array of navigation links
     *
     * @return array
     */
    public function getNavigation();

    /**
     * Load the frontend routes
     *
     * @param Loader $loader
     *
     * @return mixed
     */
    public function addRoutes(Loader $loader);

    /**
     * Load the backend routes
     *
     * @param Loader $loader
     *
     * @return mixed
     */
    public function addAdminRoutes(Loader $loader);
} 
