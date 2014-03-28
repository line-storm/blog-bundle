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
}
