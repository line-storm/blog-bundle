<?php

namespace LineStorm\BlogBundle\Entity;

use FOS\UserBundle\Entity\User as UserBase;

class User extends UserBase
{

    /**
     * @var Post[]
     *
     * @OneToMany(targetEntity="Post", mappedBy="author")
     */
    protected $posts;
}
