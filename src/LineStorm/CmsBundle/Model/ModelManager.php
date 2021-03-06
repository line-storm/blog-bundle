<?php

namespace LineStorm\CmsBundle\Model;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use LineStorm\CmsBundle\Model\Exception\ModelNotFoundException;

/**
 * Class ModelManager
 *
 * @package LineStorm\CmsBundle\Model
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

    /**
     * Create a model class
     *
     * @param $model
     * @return mixed
     * @throws Exception\ModelNotFoundException
     */
    public function create($model)
    {
        if (!array_key_exists($model, $this->mappings)) {
            throw new ModelNotFoundException();
        }

        $class = $this->mappings[$model];
        return new $class;
    }
}
