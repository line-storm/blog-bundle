<?php

namespace LineStorm\BlogBundle\Controller\Api;

use Doctrine\ORM\Query;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class AbstractApiController extends Controller
{

    protected function createResponse($data, $code=200, $headers=array())
    {
        return View::create($data, $code, $headers)
            ->setFormat('json')
        ;
    }


}
