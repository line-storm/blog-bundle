<?php

namespace LineStorm\BlogBundle\Controller\Admin\Api;

use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Form\BlogPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class PostController extends Controller implements ClassResourceInterface
{
    private $modelManager = null;

    public function getModelManager()
    {
        if(!$this->modelManager)
            $this->modelManager = $this->get('linestorm.blog.model_manager');

        return $this->modelManager;
    }

    protected function getForm($entity = null)
    {
        return $this->createForm(new BlogPostType($this->getModelManager()), $entity);
    }

    public function getAction($id)
    {

    }

    public function postAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->getModelManager();

        $request = $this->getRequest();
        $form = $this->getForm();

        $formValues = json_decode($request->getContent(), true);

        $form->submit(array(
            'linestorm_blogbundle_blogpost' => $formValues['post']
        ));

        if ($form->isValid()) {

            $em = $modelManager->getManager();
            $now = new \DateTime();

            $post = $form->getData();
            $post->setAuthor($user);
            $post->setCreatedOn($now);

            $em->persist($post);

            $em->flush();

            $view = View::createRouteRedirect('linestorm_blog_admin_module_post_api_post_get_post', array('id' => $form->getData()->getId()));
        } else {
            $view = View::create($form);
        }

        return $this->get('fos_rest.view_handler')->handle($view);


        $moduleManager = $this->get('linestorm.blog.module_manager');
        $module        = $moduleManager->getModule('post');

        $modelManager = $this->get('linestorm.blog.model_manager');

        $form = $this->createForm(new BlogPostType($modelManager));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $modelManager->getManager();
            $now = new \DateTime();

            $post = $form->getData();
            $post->setAuthor($user);
            $post->setCreatedOn($now);

            $em->persist($post);
            $em->flush();

            $this->forward('linestorm_blog_admin_module_post_component_api_get', array(
                'id' => $post,
            ));
        }

        return $this->render('LineStormBlogBundle:Modules:Post/new.html.twig', array(
            'form' => $form->createView(),
            'module' => $module,
        ));
    }

}
