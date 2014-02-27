<?php

namespace LineStorm\BlogBundle\Controller;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;
use LineStorm\BlogBundle\Entity\BasePost;
use LineStorm\BlogBundle\Entity\CategoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller implements ClassResourceInterface
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
