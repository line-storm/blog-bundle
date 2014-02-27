<?php

namespace LineStorm\BlogBundle\Controller;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Entity\BasePost;
use LineStorm\BlogBundle\Entity\PostInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BlogController extends Controller implements ClassResourceInterface
{
    public function indexAction()
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $posts = $modelManager->get('post')->findBy(array(), array('liveOn' => 'DESC'), 10);

        return $this->render('LineStormBlogBundle:Pages:index.html.twig', array(
            'posts' => $posts,
        ));
    }
}
