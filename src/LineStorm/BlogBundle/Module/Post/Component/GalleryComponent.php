<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use LineStorm\BlogBundle\Model\Post;
use LineStorm\BlogBundle\Model\PostGallery;
use Symfony\Component\Config\Loader\LoaderInterface;

class GalleryComponent extends AbstractBodyComponent implements ComponentInterface
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

    /**
     * Get the view html
     *
     * @param $entity PostGallery
     * @return string
     */
    public function getViewTemplate($entity)
    {
        return '';
    }

    /**
     * Get the new form html
     *
     * @return string
     */
    public function getNewTemplate()
    {
        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/gallery/new.html.twig');
    }

    /**
     * Get the edit html
     *
     * @param $entity PostGallery
     * @return string
     */
    public function getEditTemplate($entity)
    {
        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/gallery/new.html.twig');
    }

    public function createEntity(array $data)
    {
        $class  = $this->modelManager->getEntityClass('post_gallery');
        $entity = new $class();

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
    }

    public function handleSave(Post $post, array $data)
    {
        // TODO: Implement handleSave() method.
    }
}
