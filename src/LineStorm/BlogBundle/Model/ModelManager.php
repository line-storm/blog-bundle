<?php

namespace LineStorm\BlogBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use LineStorm\BlogBundle\Model\Exception\ModelNotFoundException;

/**
 * Class ModelManager
 *
 * @package LineStorm\BlogBundle\Model
 */
class ModelManager
{
    protected $mappings = array();

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Set the entity classes
     *
     * @param array $mappings
     *
     * @return $this
     */
    public function setMappings(array $mappings)
    {
        $this->mappings = $mappings;

        return $this;
    }

    /**
     * Set the entity manager
     *
     * @param Registry $doctrine
     * @param String   $em
     *
     * @return $this
     */
    public function setEntityManager(Registry $doctrine, $em)
    {
        $this->em = $doctrine->getManager($em);

        return $this;
    }

    /**
     * Get the entity manager
     *
     * @return EntityManager
     */
    public function getManager()
    {
        return $this->em;
    }

    /**
     * Fetch the entity namespace and class
     *
     * @param $name
     *
     * @throws Exception\ModelNotFoundException
     * @return string
     */
    public function getEntityClass($name)
    {
        if(!array_key_exists($name, $this->mappings))
        {
            throw new ModelNotFoundException($name);
        }

        return $this->mappings[$name];
    }

    /**
     * @param $model
     *
     * @throws Exception\ModelNotFoundException
     *
     * @return EntityRepository
     */
    public function get($model)
    {
        if (!array_key_exists($model, $this->mappings)) {
            throw new ModelNotFoundException();
        }

        return $this->em->getRepository($this->mappings[$model]);
    }
}
