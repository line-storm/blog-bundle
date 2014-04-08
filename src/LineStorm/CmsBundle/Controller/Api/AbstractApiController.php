<?php

namespace LineStorm\CmsBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\View\View;
use LineStorm\CmsBundle\Model\ModelManager;
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
            $this->modelManager = $this->get('linestorm.cms.model_manager');

        return $this->modelManager;
    }

    protected function createResponse($data, $code=200, $headers=array())
    {
        return View::create($data, $code, $headers)
            ->setFormat('json')
        ;
    }


}
