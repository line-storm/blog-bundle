<?php

namespace LineStorm\CmsBundle\Module;

use Symfony\Component\Config\Loader\Loader;

interface ModuleInterface {

    public function getId();

    public function getName();

    public function getHome();

    public function getNavigation();

    public function addRoutes(Loader $loader);

    public function addAdminRoutes(Loader $loader);
} 
