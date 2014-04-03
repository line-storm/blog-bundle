<?php
/**
 * Created by PhpStorm.
 * User: athorne1016
 * Date: 26/02/14
 * Time: 14:59
 */

namespace LineStorm\BlogBundle\Model\Exception;


class ModelNotFoundException extends \Exception
{

    public function __construct($name = '', $message = 'Requested Model Not Found', $code = null, $exception = null)
    {
        parent::__construct("{$message}: {$name}", $code, $exception);
    }

} 
