<?php

namespace IdNet\InvokerRouterMiddlewareTest;

use IdNet\InvokerRouterMiddleware\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class NotFoundExceptionTest extends TestCase
{

    public function testGetRequest()
    {
        $testRequest = $this->getMockBuilder(ServerRequestInterface::class)
            ->getMock();

        $request = (new NotFoundException($testRequest))
            ->getRequest();

        $this->assertEquals($request, $testRequest);
    }
}
