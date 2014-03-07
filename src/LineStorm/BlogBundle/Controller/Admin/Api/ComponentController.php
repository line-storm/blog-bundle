<?php

namespace LineStorm\BlogBundle\Controller\Admin\Api;

use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Entity\BlogPost;
use LineStorm\BlogBundle\Form\BlogPostType;
use LineStorm\BlogBundle\Module\Post\Component\ComponentInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class ComponentController extends Controller implements ClassResourceInterface
{
    private function createResponse($data, $code = 200)
    {
        return View::create()
            ->setStatusCode($code)
            ->setData($data)
            ->setFormat('json');
    }

    public function newAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');
        $module = $this->get('linestorm.blog.module.post');

        // fetch the component
        $componentName = $this->getRequest()->query->get('component');

        $component = $module->getComponent($componentName);

        if (!($component instanceof ComponentInterface)) {
            throw $this->createNotFoundException('Module or Component does not exist');
        }

        $html = $this->render('LineStormBlogBundle:Modules:Post/Component/'.$component->getId().'/new.html.twig', array(
            'module' => $module,
            'component' => $component,
        ));

        $view = $this->createResponse(array(
            'html' => $html->getContent(),
        ));

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    public function postAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager  = $this->get('linestorm.blog.model_manager');
        $em            = $modelManager->getManager();

        $moduleManager = $this->get('linestorm.blog.module_manager');
        $module        = $moduleManager->getModule('post');

        $user     = $this->getUser();
        $request  = $this->getRequest();
        $payload  = $request->getContent();

        $now      = new \DateTime();

        $data     = json_decode($payload, true);
        $postData = $data['post'];
        $compData = $data['components'];

        $form = $this->createForm(new BlogPostType($modelManager));

        $form->submit($postData);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $post = $form->getData();
            $post->setAuthor($user);
            $post->setCreatedOn($now);

            $em->persist($post);


            /** @var BlogPost $post
            $post = new $postClass();
            $post->setTitle($postData['title']);
            $post->setCategory($category);
            $post->setAuthor($user);
            $post->setCreatedOn($now);
            $post->setLiveOn($postData['liveDate']);
            $em->persist($post);*/

            $components = array();
            foreach ($compData as $cOrder => $component){
                $component = $module->getComponent($component['type']);

                if($component instanceof ComponentInterface)
                {
                    $componentEntity = $component->createEntity($component['data']);

                    $componentEntity->setPost($post);
                    $componentEntity->setOrder($cOrder);

                    $em->persist($componentEntity);
                    $components[] = $componentEntity;
                }
            }
        }
        else
        {
            var_dump($form->getErrors());
            foreach($form->getErrors() as $error)
            {
                var_dump($error->getMessage);
            }
        }

        $em->flush();
        var_dump($data);
        die();


        // fetch the component
        $componentName = $this->getRequest()->query->get('component');

        $component = $module->getComponent($componentName);

        if (!($component instanceof ComponentInterface)) {
            throw $this->createNotFoundException('Module or Component does not exist');
        }

        $html = $this->render('LineStormBlogBundle:Modules:Post/Component/'.$component->getId().'/new.html.twig', array(
            'module' => $module,
            'component' => $component,
        ));

        $view = $this->createResponse(array(
            'html' => $html->getContent(),
        ));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
