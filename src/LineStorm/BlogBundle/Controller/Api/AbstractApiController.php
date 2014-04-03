<?php

namespace LineStorm\BlogBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\View\View;
use LineStorm\BlogBundle\Model\ModelManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractApiController extends Controller
{
    private $modelManager = null;

    /**
     * @return ModelManager
     */
    protected function getModelManager()
    {
        if(!$this->modelManager)
            $this->modelManager = $this->get('linestorm.blog.model_manager');

        return $this->modelManager;
    }

    protected function createResponse($data, $code=200, $headers=array())
    {
        return View::create($data, $code, $headers)
            ->setFormat('json')
        ;
    }


}
