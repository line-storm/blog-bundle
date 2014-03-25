<?php

namespace LineStorm\BlogBundle\Module\Post\Component;

use LineStorm\BlogBundle\Model\Post;
use LineStorm\BlogBundle\Model\PostArticle;
use Symfony\Component\Config\Loader\LoaderInterface;

class ArticleComponent extends AbstractBodyComponent implements ComponentInterface
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

    /**
     * @param $entity PostArticle
     * @return string
     */
    public function getViewTemplate($entity)
    {
        return '';
    }

    public function getNewTemplate()
    {
        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/article/new.html.twig', array(
            'articles' => null,
        ));
    }

    /**
     * @param $entity PostArticle
     * @return string
     */
    public function getEditTemplate($entity)
    {
        return $this->templating->render('LineStormBlogBundle:Modules:Post/Component/article/new.html.twig', array(
            'articles' => $entity,
        ));
    }

    public function handleSave(Post $post, array $data)
    {
        $entities = array();

        foreach($data as $i => $eData)
        {
            $eData['order'] = $i;
            $article = $this->createEntity($eData);
            $post->addArticle($article);
            $entities[] = $article;
        }

        return $entities;
    }

    public function createEntity(array $data)
    {
        /** @var PostArticle $class */
        $class = $this->modelManager->getEntityClass('post_article');
        $entity = new $class();

        $entity->setOrder($data['order']);
        $entity->setBody($data['body']);

        return $entity;
    }

    public function getRoutes(LoaderInterface $loader)
    {
        return null;
        // return $loader->import('@LineStormBlogBundle/Resources/config/routing/modules/component/article.yml', 'rest');
    }
} 
