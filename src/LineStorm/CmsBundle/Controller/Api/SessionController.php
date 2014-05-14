<?php

namespace LineStorm\CmsBundle\Controller\Api;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Admin API methods
 *
 * Class Admin
 *
 * @package LineStorm\CmsBundle\Controller\Api
 */
class SessionController extends AbstractApiController
{

    /**
     * When writing long content peices, we dont want the session to time out. Here, we can ping the server to keep
     * our session alive
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pokeAction()
    {
        $user = $this->getUser();
        if(!($user instanceof UserInterface) || !($user->hasGroup('admin')))
        {
            $view = $this->createResponse(array(
                'message' => 'You have been logged out',
                'url'     => $this->generateUrl('fos_user_security_login'),
            ), 403);
        }
        else
        {
            $view = $this->createResponse(null, 204);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

} 
