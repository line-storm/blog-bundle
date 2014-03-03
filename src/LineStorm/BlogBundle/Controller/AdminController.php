<?php

namespace LineStorm\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if( !($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $moduleManager = $this->get('linestorm.blog.module_manager');

        return $this->render('LineStormBlogBundle:Admin:index.html.twig', array(
            'modules' => $moduleManager->getModules(),
        ));
    }

    public function moduleAction($module)
    {
        $user = $this->getUser();
        if( !($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            throw new AccessDeniedException();
        }

        $moduleManager = $this->get('linestorm.blog.module_manager');

        $moduleObject = $moduleManager->getModule($module);

        return $moduleObject->getPage();
    }
}
