<?php

namespace LineStorm\BlogBundle\Controller;

use Doctrine\ORM\Query;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Entity\BasePost;
use LineStorm\BlogBundle\Entity\PostInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PostController extends Controller implements ClassResourceInterface
{
    private function createResponse($data, $code=200)
    {
        return View::create()
            ->setStatusCode($code)
            ->setData($data)
            ->setFormat('json')
        ;
    }


    /**
     * Get a list of all consumables
     *
     * [GET] /api/blog/posts.{_format}
     */
    public function cgetAction()
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $em = $modelManager->getManager();

        $dql = "
            SELECT
                partial p.{id,title,body,createdOn}
            FROM
                {$modelManager->getEntityClass('post')} p
        ";
        $posts = $em->createQuery($dql)->getArrayResult();

        $this->createResponse($posts);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


    /**
     * Get a post
     *
     * [GET] /api/blog/post/{id}.{_format}
     */
    public function getAction($id)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $em = $modelManager->getManager();

        $dql = "
            SELECT
                partial p.{id,title,createdOn}
            FROM
                {$modelManager->getEntityClass('post')} p
            WHERE
                p.id = ?1
        ";
        $post = $em->createQuery($dql)->setParameter(1, $id)->getOneOrNullResult(Query::HYDRATE_ARRAY);

        $view = $this->createResponse($post, is_array($post) ? 200 : 404);

        return $this->get('fos_rest.view_handler')->handle($view);
    }


    /**
     * Get an edit form for a post
     *
     * [GET] /api/blog/post/{id}/edit
     */
    public function editAction($id)
    {
        $user = $this->getUser();
        if(!$user->hasGroup('admin'))
        {
            throw new AccessDeniedException();
        }

        $modelManager = $this->get('linestorm.blog.model_manager');

        $em = $modelManager->getManager();

        $dql = "
            SELECT
                partial p.{id,title,body,liveOn},
                t,
                c,
                partial a.{id, username}
            FROM
                {$modelManager->getEntityClass('post')} p
                JOIN p.tags t
                JOIN p.category c
                JOIN p.author a
            WHERE
                p.id = ?1
        ";

        $csrf = $this->get('form.csrf_provider');
        $token = $csrf->generateCsrfToken('blog_post_edit');

        $post = $em->createQuery($dql)->setParameter(1, $id)->getOneOrNullResult(Query::HYDRATE_ARRAY);

        $post['_csrf'] = $token;
        $view = $this->createResponse($post, is_array($post) ? 200 : 404);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    public function displayAction($category, $id, $slug)
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $post = $modelManager->get('post')->find($id);

        if(!($post instanceof PostInterface))
        {
            throw $this->createNotFoundException("Post Not Found");
        }

        return $this->render('LineStormBlogBundle:Post:display.html.twig', array(
            'post' => $post,
        ));
    }

    public function createAction()
    {
        $modelManager = $this->get('linestorm.blog.model_manager');

        $posts = $modelManager->get('post')->findBy(array(), array('liveOn' => 'DESC'), 10);

        return $this->render('LineStormBlogBundle:Post:create.html.twig', array(
            'posts' => $posts,
        ));
    }
}
