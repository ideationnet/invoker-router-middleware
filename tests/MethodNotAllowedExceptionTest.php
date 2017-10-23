<?php

namespace IdNet\InvokerRouterMiddlewareTest;

use IdNet\InvokerRouterMiddleware\Exception\MethodNotAllowedException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class MethodNotAllowedExceptionTest extends TestCase
{

    public function testRequest()
    {
        $testRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $request = (new MethodNotAllowedException($testRequest, []))
            ->getRequest();

        $this->assertEquals($request, $testRequest);
    }

    public function testAllowedMethods()
    {
        $testRequest = $this->getMockBuilder(ServerRequestInterface::class)
          ->getMock();

        $methods = (new MethodNotAllowedException($testRequest, ['GET']))
          ->getAllowedMethods();

        $this->assertEquals($methods, ['GET']);
    }
}
