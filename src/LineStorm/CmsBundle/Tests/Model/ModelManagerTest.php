<?php

namespace LineStorm\CmsBundle\Tests\Model;

/**
 * Unit tests got model manager
 *
 * Class ModelManagerTest
 *
 * @package LineStorm\CmsBundle\Tests\Model
 */
class ModelManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Default Entity mappings
     *
     * @var array
     */
    private $mappings = array(
        'map1' => 'LineStorm\CmsBundle\Tests\Fixtures\Entities\TestBlankEntity',
        'map2' => 'value2',
        'map3' => 'value3',
    );

    /**
     * Build a model manager
     *
     * @return \LineStorm\CmsBundle\Model\ModelManager
     */
    private function getModelManager()
    {
        $modelManager = new \LineStorm\CmsBundle\Model\ModelManager();

        $modelManager->setMappings($this->mappings);

        return $modelManager;
    }

    public function testGetEntityClass()
    {
        $modelManager = $this->getModelManager();

        $entityClass = $modelManager->getEntityClass('map1');
        $this->assertEquals($this->mappings['map1'], $entityClass);
    }

    public function testGetRepository()
    {
        $modelManager = $this->getModelManager();

        $doctrine = $this->getMock('\Doctrine\Bundle\DoctrineBundle\Registry', array('getManager'), array(), '', false);
        $em = $this->getMock('\Doctrine\ORM\Entitymanager', array('getRepository'), array(), '', false);
        $repository = $this->getMock('\Doctrine\ORM\EntityRepository', array(), array(), '', false);

        $doctrine->expects($this->once())
            ->method('getManager')
            ->with('default')
            ->will($this->returnValue($em));

        $em->expects($this->once())
            ->method('getRepository')
            ->with($this->mappings['map1'])
            ->will($this->returnValue($repository));

        $modelManager->setEntityManager($doctrine, 'default');

        $repo = $modelManager->get('map1');

        $this->assertEquals($repository, $repo);
    }


    public function testGetManager()
    {
        $modelManager = $this->getModelManager();

        $doctrine = $this->getMock('\Doctrine\Bundle\DoctrineBundle\Registry', array('getManager'), array(), '', false);
        $em = $this->getMock('\Doctrine\ORM\Entitymanager', array('getRepository'), array(), '', false);
        $doctrine->expects($this->once())
            ->method('getManager')
            ->with('default')
            ->will($this->returnValue($em));

        $modelManager->setEntityManager($doctrine, 'default');

        $manager = $modelManager->getManager();

        $this->assertEquals($manager, $em);
    }

    public function testCreateEntity()
    {
        $modelManager = $this->getModelManager();

        $model = $modelManager->create('map1');

        $this->assertInstanceOf($this->mappings['map1'], $model);
    }

    /**
     * @expectedException \LineStorm\CmsBundle\Model\Exception\ModelNotFoundException
     */
    public function testGetEntityNotFound()
    {
        $modelManager = $this->getModelManager();

        $modelManager->get('unknown_model');
    }

    /**
     * @expectedException \LineStorm\CmsBundle\Model\Exception\ModelNotFoundException
     */
    public function testGetEntityClassNotFound()
    {
        $modelManager = $this->getModelManager();

        $modelManager->getEntityClass('unknown_model');
    }

    /**
     * @expectedException \LineStorm\CmsBundle\Model\Exception\ModelNotFoundException
     */
    public function testCreateEntityNotFound()
    {
        $modelManager = $this->getModelManager();

        $modelManager->create('unknown_model');
    }
} 
