<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BlogPostGalleryPicture
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    protected $body;

    /**
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    protected $order;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", nullable=false)
     */
    protected $src;

    /**
     * @var string
     *
     * @ORM\Column(name="seo", type="string", nullable=false)
     */
    protected $seo;

    /**
     * @var BlogPostGallery[]
     *
     * @ORM\ManyToOne(targetEntity="BlogPostGallery", inversedBy="pictures")
     */
    protected $gallery;

}
