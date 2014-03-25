<?php

namespace LineStorm\BlogBundle\Controller\Admin;

use LineStorm\BlogBundle\Form\BlogPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class PostController extends Controller
{
    public function listAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $posts = $modelManager->get('post')->findAll();

        return $this->render('LineStormBlogBundle:Modules:Post/list.html.twig', array(
            'posts' => $posts,
        ));
    }


    public function editAction($id)
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $moduleManager = $this->get('linestorm.blog.module_manager');
        $module        = $moduleManager->getModule('post');

        $modelManager = $this->get('linestorm.blog.model_manager');
        $post = $modelManager->get('post')->find($id);

        $form = $this->createForm(new BlogPostType($modelManager), $post, array(
            'action' => $this->generateUrl('linestorm_blog_admin_module_post_api_post_post_post'),
            'method' => 'POST',
        ));

        return $this->render('LineStormBlogBundle:Modules:Post/edit.html.twig', array(
            'post'      => $post,
            'form'      => $form->createView(),
            'module'    => $module,
        ));
    }


    public function newAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $moduleManager = $this->get('linestorm.blog.module_manager');
        $module        = $moduleManager->getModule('post');

        $modelManager = $this->get('linestorm.blog.model_manager');

        $form = $this->createForm(new BlogPostType($modelManager), null, array(
            'action' => $this->generateUrl('linestorm_blog_admin_module_post_api_post_post_post'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary')));

        return $this->render('LineStormBlogBundle:Modules:Post/new.html.twig', array(
            'form' => $form->createView(),
            'module' => $module,
        ));
    }

}
