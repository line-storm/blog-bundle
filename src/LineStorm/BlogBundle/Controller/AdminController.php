<?php

namespace LineStorm\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
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
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $moduleManager = $this->get('linestorm.blog.module_manager');

        $moduleObject = $moduleManager->getModule($module);

        return $moduleObject->getPage();
    }

    public function uploadAction()
    {
        $user = $this->getUser();
        if (!($user instanceof UserInterface) || !($user->hasGroup('admin'))) {
            throw new AccessDeniedException();
        }

        $storeFolder = '/var/www/andythorne/web/media/';

        $request = $this->getRequest();
        $files = $request->files->all();

        $accept = array(
            'image/jpeg' => array('jpg', 'jpeg'),
            'image/png'  => array('png'),
            'image/gif'  => array('gif'),
        );

        $totalFiles = count($files);

        // only allow single uploads
        if($totalFiles === 1) {
            /* @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
            $file = array_shift($files);
            $fileMime = $file->getMimeType();
            if (array_key_exists($fileMime, $accept) && in_array($file->getClientOriginalExtension(), $accept[$fileMime])) {
                $newFileName = md5(time() . rand()) . "." . $file->getClientOriginalExtension();
                $newFile = $file->move($storeFolder, $newFileName);
            }
            else
            {
                throw new HttpException(400, 'Upload Invalid');
            }

        }

        $jsonResponse = new JsonResponse();
        $jsonResponse->setData(array(
            'url' => '/media/'.$newFile->getFilename(),
            'file' => $newFile->getBasename(),
            'ext'  => $newFile->getExtension(),
        ));

        return $jsonResponse;
    }
}
