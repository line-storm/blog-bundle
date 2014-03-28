<?php

namespace LineStorm\BlogBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;

class CategoryController extends AbstractApiController implements ClassResourceInterface
{
    public function displayAction($category)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $category = $modelManager->get('category')->findOneByName($category);

        if (!($category instanceof CategoryInterface)) {
            throw $this->createNotFoundException("Category Not Found");
        }

        $posts = $modelManager->get('post')->findBy(array('category' => $category), array('liveOn' => 'DESC'), 10);

        return $this->render('LineStormBlogBundle:Category:display.html.twig', array(
            'category' => $category,
            'posts'    => $posts,
        ));
    }
}
