<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogCompetitionTerm
 * @package LineStorm\BlogBundle\Entity
 */
abstract class BlogCompetitionTerm
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
     * @var integer
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    protected $order;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCompetition
     *
     * @ORM\ManyToMany(targetEntity="BlogCompetition", mappedBy="terms")
     */
    protected $category;

}
