<?php

namespace LineStorm\CmsBundle\Api;

/**
 * Class ApiExceptionResponse
 *
 * @package LineStorm\CmsBundle\Api
 * @author  Andy Thorne <contrabandvr@gmail.com>
 */
class ApiExceptionResponse
{
    protected $code;
    protected $message;

    /**
     * @param $code
     * @param $message
     */
    function __construct($message='', $code=500)
    {
        $this->code    = $code;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

} 
