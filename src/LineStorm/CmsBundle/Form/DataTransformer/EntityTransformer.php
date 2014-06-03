<?php

namespace LineStorm\CmsBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use LineStorm\MediaBundle\Model\Media;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class EntityTransformer
 *
 * @package LineStorm\CmsBundle\Form\DataTransformer
 */
class EntityTransformer implements DataTransformerInterface
{
    /**
     * EntityManager
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Class of entity
     *
     * @var string
     */
    private $class;

    /**
     * @param EntityManager $entityManager
     * @param string        $class
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        $this->entityManager = $entityManager;
        $this->class         = $class;
    }

    /**
     * Transforms the Document's value to a value for the form field
     *
     * @param mixed $data
     *
     * @return int|null
     */
    public function transform($data)
    {
        if($data instanceof $this->class)
        {
            return $data->getId();
        }

        return null;
    }

    /**
     * Transforms the value the users has typed to a value that suits the field in the Document
     *
     * @param mixed $data
     *
     * @return Media|null
     */
    public function reverseTransform($data)
    {
        if(!is_numeric($data))
        {
            return null;
        }

        $repo    = $this->entityManager->getRepository($this->class);
        $fetched = $repo->find($data);

        if($fetched instanceof $this->class)
        {
            return $fetched;
        }

        return null;
    }
}
