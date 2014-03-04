<?php
/**
 * Created by PhpStorm.
 * User: athorne1016
 * Date: 03/03/14
 * Time: 12:29
 */

namespace LineStorm\BlogBundle\Module;

use Symfony\Component\Config\Loader\LoaderInterface;

interface ModuleInterface {

    public function getId();

    public function getName();

    public function getHome();

    public function getNavigation();

    public function addRoutes(LoaderInterface $loader);
} 
