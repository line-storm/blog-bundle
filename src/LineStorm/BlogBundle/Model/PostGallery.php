<?php

namespace LineStorm\BlogBundle\Model;

use Doctrine\ORM\Mapping as ORM;

class PostGallery
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
     * @var PostGalleryImage[]
     */
    protected $images;

    /**
     * @var Post
     */
    protected $post;

}
