<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class BlogPost
{
    /*
     * TODO:
     *  $comments <- FOSCommentBundle
     *  $votes
     */

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
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    protected $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    protected $createdOn;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_on", type="datetime", nullable=false)
     */
    protected $editedOn;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="edited_by", referencedColumnName="id")
     */
    protected $editedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="live_on", type="datetime", nullable=false)
     */
    protected $liveOn;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCategory
     *
     * @ORM\ManyToOne(targetEntity="BlogCategory", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="BlogTag")
     * @ORM\JoinTable(name="users_groups")
     */
    protected $tags;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogPost
     *
     * @ORM\ManyToOne(targetEntity="BlogPost", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="BlogPost", mappedBy="parent")
     */
    protected $children;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_on", type="datetime", nullable=true)
     */
    protected $deletedOn;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="deleted_by", referencedColumnName="id")
     */
    protected $deletedBy;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getSlug()
    {
        return strtolower(str_replace(' ', '-', $this->title));
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
     * Set title
     *
     * @param string $title
     * @return BlogPost
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return BlogPost
     */
    public function setBody($body)
    {
        $this->body = $body;
    
        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return BlogPost
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
     * Set editedOn
     *
     * @param \DateTime $editedOn
     * @return BlogPost
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
     * Set liveOn
     *
     * @param \DateTime $liveOn
     * @return BlogPost
     */
    public function setLiveOn($liveOn)
    {
        $this->liveOn = $liveOn;
    
        return $this;
    }

    /**
     * Get liveOn
     *
     * @return \DateTime 
     */
    public function getLiveOn()
    {
        return $this->liveOn;
    }

    /**
     * Set deletedOn
     *
     * @param \DateTime $deletedOn
     * @return BlogPost
     */
    public function setDeletedOn($deletedOn)
    {
        $this->deletedOn = $deletedOn;
    
        return $this;
    }

    /**
     * Get deletedOn
     *
     * @return \DateTime 
     */
    public function getDeletedOn()
    {
        return $this->deletedOn;
    }

    /**
     * Set author
     *
     * @param \LineStorm\BlogBundle\Entity\User $author
     * @return BlogPost
     */
    public function setAuthor(\LineStorm\BlogBundle\Entity\User $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \LineStorm\BlogBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set editedBy
     *
     * @param \LineStorm\BlogBundle\Entity\User $editedBy
     * @return BlogPost
     */
    public function setEditedBy(\LineStorm\BlogBundle\Entity\User $editedBy = null)
    {
        $this->editedBy = $editedBy;
    
        return $this;
    }

    /**
     * Get editedBy
     *
     * @return \LineStorm\BlogBundle\Entity\User 
     */
    public function getEditedBy()
    {
        return $this->editedBy;
    }

    /**
     * Set category
     *
     * @param \LineStorm\BlogBundle\Entity\BlogCategory $category
     * @return BlogPost
     */
    public function setCategory(\LineStorm\BlogBundle\Entity\BlogCategory $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \LineStorm\BlogBundle\Entity\BlogCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add tags
     *
     * @param \LineStorm\BlogBundle\Entity\BlogTag $tags
     * @return BlogPost
     */
    public function addTag(\LineStorm\BlogBundle\Entity\BlogTag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \LineStorm\BlogBundle\Entity\BlogTag $tags
     */
    public function removeTag(\LineStorm\BlogBundle\Entity\BlogTag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set parent
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPost $parent
     * @return BlogPost
     */
    public function setParent(\LineStorm\BlogBundle\Entity\BlogPost $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \LineStorm\BlogBundle\Entity\BlogPost 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPost $children
     * @return BlogPost
     */
    public function addChildren(\LineStorm\BlogBundle\Entity\BlogPost $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPost $children
     */
    public function removeChildren(\LineStorm\BlogBundle\Entity\BlogPost $children)
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
     * Set deletedBy
     *
     * @param \LineStorm\BlogBundle\Entity\User $deletedBy
     * @return BlogPost
     */
    public function setDeletedBy(\LineStorm\BlogBundle\Entity\User $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;
    
        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return \LineStorm\BlogBundle\Entity\User 
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }
}
