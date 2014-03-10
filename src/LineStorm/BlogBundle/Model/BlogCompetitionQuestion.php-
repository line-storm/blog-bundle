<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogCompetitionQuestion
 * @package LineStorm\BlogBundle\Entity
 */
abstract class BlogCompetitionQuestion
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
     * @var BlogCompetition
     *
     * @ORM\ManyToOne(targetEntity="BlogCompetition", inversedBy="questions")
     */
    protected $competition;

    /**
     * @var \LineStorm\BlogBundle\Entity\BlogCompetitionQuestionOption
     *
     * @ORM\ManyToOne(targetEntity="BlogCompetitionQuestionOption", inversedBy="question")
     */
    protected $options;

}
