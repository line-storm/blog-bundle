<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use Symfony\Component\Config\Loader\LoaderInterface;

class GalleryComponent extends AbstractComponent implements ComponentInterface
{
    private $name = 'Gallery';
    private $id = 'gallery';

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getViewTemplate()
    {
        return '';
    }

    public function getEditTemplate()
    {
        return '';
    }

    public function createEntity(array $data)
    {
        $class = $this->modelManager->getEntityClass('post_gallery');
        $entity = new $class();

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
    }
}
