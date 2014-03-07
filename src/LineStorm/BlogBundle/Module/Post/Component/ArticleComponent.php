<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use LineStorm\BlogBundle\Entity\BlogPostArticle;
use Symfony\Component\Config\Loader\LoaderInterface;

class ArticleComponent extends AbstractComponent implements ComponentInterface
{
    private $name = 'Article';
    private $id = 'article';

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
        /** @var BlogPostArticle $class */
        $class = $this->modelManager->getEntityClass('post_article');
        $entity = new $class();

        $entity->setBody($data['body']);

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
        // return $loader->import('@LineStormBlogBundle/Resources/config/routing/modules/component/article.yml', 'rest');
    }
} 
