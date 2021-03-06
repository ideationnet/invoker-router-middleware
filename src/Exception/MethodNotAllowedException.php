<?php

namespace IdNet\InvokerRouterMiddleware\Exception;

use Exception;
use Psr\Http\Message\ServerRequestInterface;

class MethodNotAllowedException extends Exception
{
    /** @var ServerRequestInterface */
    protected $request;

    protected $allowedMethods = [];

    public function __construct(
        ServerRequestInterface $request,
        $allowedMethods,
        $code = 405
    ) {
        $this->request = $request;
        $this->allowedMethods = $allowedMethods;
        parent::__construct("Method not allowed", $code);
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }
}
