<?php

namespace LineStorm\BlogBundle\Model;

use Doctrine\ORM\Mapping as ORM;

class PostGalleryImage
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
     * @var string
     */
    protected $src;

    /**
     * @var string
     */
    protected $seo;

    /**
     * @var PostGallery[]
     */
    protected $gallery;

}
