<?php

namespace LineStorm\BlogBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Model\Category;
use LineStorm\BlogBundle\Model\ModelManager;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class CategoryController extends AbstractApiController implements ClassResourceInterface
{
    private $modelManager = null;

    /**
     * @return ModelManager
     */
    private function getModelManager()
    {
        if(!$this->modelManager)
            $this->modelManager = $this->get('linestorm.blog.model_manager');

        return $this->modelManager;
    }

    private function getForm($entity = null)
    {
        return $this->createForm('linestorm_blog_form_category', $entity);
    }

    public function cgetAction()
    {
        $modelManager = $this->getModelManager();

        $categories = $modelManager->get('category')->findAll();

        $view = View::create($categories);
        return $this->get('fos_rest.view_handler')->handle($view);

    }

    public function getAction($id)
    {
        $modelManager = $this->getModelManager();

        $category = $modelManager->get('category')->find($id);
        if(!($category instanceof Category))
        {
            throw $this->createNotFoundException("Category not found");
        }

        $view = View::create($category);
        return $this->get('fos_rest.view_handler')->handle($view);

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

        $form->submit($formValues['linestorm_blog_form_category']);

        if ($form->isValid()) {

            $em = $modelManager->getManager();
            $now = new \DateTime();

            /** @var Category $category */
            $category = $form->getData();
            $category->setCreatedOn($now);
            $category->setEditedOn($now);

            $em->persist($category);
            $em->flush();

            $view = View::create(null, 201, array(
                'location' => $this->generateUrl('linestorm_blog_api_get_category', array( 'id' => $category->getId() ))
            ));
        } else {
            $view = View::create($form);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    public function putAction($id)
    {

        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->getModelManager();

        $category = $modelManager->get('category')->find($id);
        if(!($category instanceof Category))
        {
            throw $this->createNotFoundException("Category not found");
        }

        $request = $this->getRequest();
        $form = $this->getForm($category);

        $formValues = json_decode($request->getContent(), true);

        $form->submit($formValues['linestorm_blog_form_category']);

        if ($form->isValid())
        {
            $em = $modelManager->getManager();
            $now = new \DateTime();

            /** @var Category $updatedCategory */
            $updatedCategory = $form->getData();
            $updatedCategory->setEditedOn($now);

            $em->persist($updatedCategory);
            $em->flush();

            $view = $this->createResponse(array('location' => $this->generateUrl('linestorm_blog_api_get_category', array( 'id' => $updatedCategory->getId()))), 200);
        }
        else
        {
            $view = View::create($form);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    public function deleteAction($id)
    {

        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $modelManager = $this->getModelManager();

        $category = $modelManager->get('category')->find($id);
        if(!($category instanceof Category))
        {
            throw $this->createNotFoundException("Category not found");
        }

        $em = $modelManager->getManager();
        $em->remove($category);

        $view = View::create(null);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


    public function newAction()
    {

        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm('linestorm_blog_form_category', null, array(
            'action' => $this->generateUrl('linestorm_blog_api_post_category'),
            'method' => 'POST',
        ));

        $view = $form->createView();

        /** @var \Symfony\Bundle\FrameworkBundle\Templating\Helper\FormHelper $tpl */
        $tpl = $this->get('templating.helper.form');
        $tpl->setTheme($view, 'asdasd');//array('LineStormBlogBundle:Admin:Form/fields.html.twig'));
        $form = $tpl->form($view);

        $rView = View::create(array(
            'form' => $form
        ));

        return $this->get('fos_rest.view_handler')->handle($rView);
    }
}
