<?php
/**
 * Created by PhpStorm.
 * User: athorne1016
 * Date: 03/03/14
 * Time: 15:00
 */

namespace LineStorm\BlogBundle\Module;

abstract class AbstractModule
{
    protected $name;
    protected $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
