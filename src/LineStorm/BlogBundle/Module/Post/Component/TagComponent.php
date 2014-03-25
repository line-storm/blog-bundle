<?php

namespace LineStorm\BlogBundle\Module\Post\Component;


use LineStorm\BlogBundle\Model\Post;
use LineStorm\BlogBundle\Model\Tag;
use Symfony\Component\Config\Loader\LoaderInterface;

class TagComponent extends AbstractBodyComponent implements ComponentInterface
{
    private $name = 'Tag';
    private $id = 'tag';

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $entity Tag
     * @return string
     */
    public function getViewTemplate($entity)
    {
        return '';
    }

    public function getNewTemplate()
    {
        $tags = $this->modelManager->get('tag')->findBy(array(), array('name' => 'ASC'));

        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/tag/new.html.twig', array(
            'tagEntities'   => null,
            'component'     => $this,
            'tags'          => $tags,
        ));
    }

    /**
     * @param $entity Tag
     * @return string
     */
    public function getEditTemplate($entity)
    {
        $tags = $this->modelManager->get('tag')->findBy(array(), array('name' => 'ASC'));

        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/tag/new.html.twig', array(
            'tagEntities'   => $entity,
            'component'     => $this,
            'tags'          => $tags,
        ));
    }


    public function handleSave(Post $post, array $data)
    {
        $entities = array();

        foreach ($data as $eData) {
            $tag = $this->getEntityByName($eData);
            if (!($tag instanceof Tag)) {
                $tag = $this->createEntity($eData);
            }
            $post->addTag($tag);
            $entities[] = $tag;
        }

        return $entities;
    }

    public function getEntityByName(array $data)
    {
        return $this->modelManager->get('tag')->findOneBy(array(
            'name' => $data['name']
        ));
    }

    public function createEntity(array $data)
    {
        $class  = $this->modelManager->getEntityClass('tag');
        $entity = new $class();

        $entity->setName($data['name']);

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
    }
} 
