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



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gallery
     *
     * @param PostGallery $gallery
     * @return PostGalleryImage
     */
    public function setGallery(PostGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return PostGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $seo
     */
    public function setSeo($seo)
    {
        $this->seo = $seo;
    }

    /**
     * @return string
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * @param string $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }
    
    
}
