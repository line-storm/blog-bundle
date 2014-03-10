<?php

namespace LineStorm\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BlogCompetitionQuestion
 * @package LineStorm\BlogBundle\Entity
 */
abstract class BlogCompetitionQuestionOption
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
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    protected $order;

    /**
     * @var boolean
     *
     * @ORM\Column(name="correct", type="boolean", nullable=false)
     */
    protected $correct = false;

    /**
     * @var BlogCompetition
     *
     * @ORM\ManyToOne(targetEntity="BlogCompetitionQuestion", inversedBy="options")
     */
    protected $question;

}
