<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;

/**
 * @ORM\Table(name="blog_post")
 * @ORM\Entity
 *
 * @ORM\HasLifecycleCallbacks
 */
class BlogPost
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
     * @var \FOS\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\FOS\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="edited_on", type="datetime", nullable=true)
     */
    protected $editedOn;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="\FOS\UserBundle\Entity\User")
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
     * @ORM\ManyToMany(targetEntity="BlogTag", cascade={"persist"})
     * @ORM\JoinTable(name="blog_post_tag")
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
     * @var \FOS\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="\FOS\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="deleted_by", referencedColumnName="id")
     */
    protected $deletedBy;

    /**
     * @var BlogPostArticle[]
     *
     * @ORM\OneToMany(targetEntity="BlogPostArticle", mappedBy="post", cascade={"persist", "remove"})
     */
    protected $articles;

    /**
     * @var BlogPostGallery[]
     *
     * @ORM\OneToMany(targetEntity="BlogPostGallery", mappedBy="post", cascade={"persist", "remove"})
     */
    protected $galleries;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->galleries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if($this->createdOn === null)
            $this->createdOn = new \DateTime();
        else
            $this->editedOn = new \DateTime();
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
     * @param \FOS\UserBundle\Entity\User $author
     * @return BlogPost
     */
    public function setAuthor(UserInterface $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \FOS\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set editedBy
     *
     * @param \FOS\UserBundle\Entity\User $editedBy
     * @return BlogPost
     */
    public function setEditedBy(UserInterface $editedBy = null)
    {
        $this->editedBy = $editedBy;
    
        return $this;
    }

    /**
     * Get editedBy
     *
     * @return \FOS\UserBundle\Entity\User
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
     * @param \FOS\UserBundle\Entity\User $deletedBy
     * @return BlogPost
     */
    public function setDeletedBy(UserInterface $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;
    
        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return \FOS\UserBundle\Entity\User
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * Add articles
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPostArticle $articles
     * @return BlogPost
     */
    public function addArticle(\LineStorm\BlogBundle\Entity\BlogPostArticle $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPostArticle $articles
     */
    public function removeArticle(\LineStorm\BlogBundle\Entity\BlogPostArticle $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function hasArticle(\LineStorm\BlogBundle\Entity\BlogPostArticle $article = null)
    {
        return $this->articles->contains($article);
    }

    /**
     * Add galleries
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPostGallery $galleries
     * @return BlogPost
     */
    public function addGallery(\LineStorm\BlogBundle\Entity\BlogPostGallery $galleries)
    {
        $this->galleries[] = $galleries;

        return $this;
    }

    /**
     * Remove galleries
     *
     * @param \LineStorm\BlogBundle\Entity\BlogPostGallery $galleries
     */
    public function removeGallery(\LineStorm\BlogBundle\Entity\BlogPostGallery $galleries)
    {
        $this->galleries->removeElement($galleries);
    }

    /**
     * Get galleries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleries()
    {
        return $this->galleries;
    }
}
