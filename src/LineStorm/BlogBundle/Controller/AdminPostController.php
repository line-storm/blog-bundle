<?php

namespace LineStorm\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LineStorm\BlogBundle\Entity\BlogPost;
use LineStorm\BlogBundle\Form\BlogPostType;

/**
 * BlogPost controller.
 *
 */
class AdminPostController extends Controller
{

    /**
     * Lists all BlogPost entities.
     *
     */
    public function indexAction()
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $entities = $modelManager->get('post')->findAll();

        return $this->render('LineStormBlogBundle:Admin:Post/index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new BlogPost entity.
     *
     */
    public function createAction(Request $request)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');
        $class = $modelManager->getEntityClass('post');
        $entity = new $class();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setAuthor($this->getUser());
            $entity->setCreatedOn(new \DateTime());
            $entity->setEditedOn(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('linestorm_blog_admin_post_show', array('id' => $entity->getId())));
        }

        return $this->render('LineStormBlogBundle:Admin:Post/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a BlogPost entity.
     *
     * @param BlogPost $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BlogPost $entity)
    {
        $form = $this->createForm(new BlogPostType($this->get('linestorm.blog.model_manager')), $entity, array(
            'action' => $this->generateUrl('linestorm_blog_admin_post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BlogPost entity.
     *
     */
    public function newAction()
    {
        $modelManager = $this->get('linestorm.blog.model_manager');
        $class = $modelManager->getEntityClass('post');

        $entity = new $class();
        $form   = $this->createCreateForm($entity);

        return $this->render('LineStormBlogBundle:Admin:Post/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogPost entity.
     *
     */
    public function showAction($id)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $entity = $modelManager->get('post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LineStormBlogBundle:Admin:Post/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogPost entity.
     *
     */
    public function editAction($id)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $entity = $modelManager->get('post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LineStormBlogBundle:Admin:Post/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a BlogPost entity.
    *
    * @param BlogPost $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BlogPost $entity)
    {
        $form = $this->createForm(new BlogPostType($this->get('linestorm.blog.model_manager')), $entity, array(
            'action' => $this->generateUrl('linestorm_blog_admin_post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BlogPost entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');
        $em = $modelManager->getManager();
        $entity = $modelManager->get('post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BlogPost entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('linestorm_blog_admin_post_edit', array('id' => $id)));
        }

        return $this->render('LineStormBlogBundle:Admin:Post/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a BlogPost entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $modelManager = $this->get('linestorm.blog.model_manager');
            $entity = $modelManager->get('post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BlogPost entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('linestorm_blog_admin_post'));
    }

    /**
     * Creates a form to delete a BlogPost entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('linestorm_blog_admin_post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
