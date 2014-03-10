<?php

namespace LineStorm\BlogBundle\Model;

use Doctrine\ORM\Mapping as ORM;

class PostArticle
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var integer
     */
    protected $order;

    /**
     * @var Post
     */
    protected $post;

}
