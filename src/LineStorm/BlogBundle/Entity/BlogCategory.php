<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

abstract class BlogCategory
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_on", type="datetime", nullable=false)
     */
    protected $editedOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    protected $createdOn;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCategory
     *
     * @ORM\ManyToOne(targetEntity="BlogCategory", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="BlogCategory", mappedBy="parent")
     */
    protected $children;


    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="category")
     */
    protected $posts;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return BlogCategory
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set editedOn
     *
     * @param \DateTime $editedOn
     * @return BlogCategory
     */
    public function setEditedOn($editedOn)
    {
        $this->editedOn = $editedOn;
    
        return $this;
    }

    /**
     * Get editedOn
     *
     * @return \DateTime 
     */
    public function getEditedOn()
    {
        return $this->editedOn;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return BlogCategory
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set parent
     *
     * @param \LineStorm\BlogBundle\Entity\BlogCategory $parent
     * @return BlogCategory
     */
    public function setParent(\LineStorm\BlogBundle\Entity\BlogCategory $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \LineStorm\BlogBundle\Entity\BlogCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \LineStorm\BlogBundle\Entity\BlogCategory $children
     * @return BlogCategory
     */
    public function addChildren(\LineStorm\BlogBundle\Entity\BlogCategory $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \LineStorm\BlogBundle\Entity\BlogCategory $children
     */
    public function removeChildren(\LineStorm\BlogBundle\Entity\BlogCategory $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add posts
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPost $posts
     * @return BlogCategory
     */
    public function addPost(\LineStorm\BlogBundle\Entity\BlogPost $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPost $posts
     */
    public function removePost(\LineStorm\BlogBundle\Entity\BlogPost $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
