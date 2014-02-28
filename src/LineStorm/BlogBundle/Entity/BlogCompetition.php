<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogCompetition
 * @package LineStorm\BlogBundle\Entity
 */
abstract class BlogCompetition
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
    protected $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="body", type="text", nullable=false)
     */
    protected $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_on", type="datetime", nullable=false)
     */
    protected $startOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_on", type="datetime", nullable=false)
     */
    protected $endOn;

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
     * @ORM\Column(name="edited_on", type="datetime", nullable=true)
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
     * @var \LineStorm\BlogBundle\Entity\BlogCategory
     *
     * @ORM\ManyToOne(targetEntity="BlogCategory", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCompetitionQuestion
     *
     * @ORM\ManyToOne(targetEntity="BlogCompetitionQuestion", inversedBy="competition")
     */
    protected $questions;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCompetitionTerm
     *
     * @ORM\ManyToMany(targetEntity="BlogCompetitionTerm", inversedBy="competition")
     * @ORM\JoinTable(name="blog_competition_competition_term")
     */
    protected $terms;

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

}
