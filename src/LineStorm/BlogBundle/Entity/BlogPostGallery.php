<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BlogPostGallery
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
     * @var
     *
     * @ORM\OneToMany(targetEntity="BlogPostGallery", mappedBy="gallery")
     */
    protected $images;

    /**
     * @var BlogPost
     *
     * @ORM\ManyToOne(targetEntity="BlogPost", inversedBy="galleries")
     */
    protected $post;

}
