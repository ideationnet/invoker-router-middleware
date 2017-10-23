<?php

namespace IdNet\InvokerRouterMiddlewareTest;

use FastRoute\Dispatcher;
use IdNet\InvokerRouterMiddleware\Exception\MethodNotAllowedException;
use IdNet\InvokerRouterMiddleware\Exception\NotFoundException;
use IdNet\InvokerRouterMiddleware\InvokerRouterMiddleware;
use Interop\Http\Server\RequestHandlerInterface;
use Invoker\InvokerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class InvokerRouterMiddlewareTest extends TestCase
{

    public function testCreateDispatcher()
    {
        $routes = [
            ['GET', '/', 'test']
        ];
        $dispatcher = InvokerRouterMiddleware::createDispatcherFromRouteArray($routes);
        $routeInfo = $dispatcher->dispatch('GET', '/');
        $this->assertEquals($routeInfo[1], 'test');
    }

    public function testMethodNotAllowed()
    {
        $testResponse = $this->getMockBuilder(ResponseInterface::class)
          ->getMock();

        $uri = $this->getMockBuilder(UriInterface::class)
          ->getMock();

        $request = $this->getMockBuilder(ServerRequestInterface::class)
          ->getMock();
        $request->method('getUri')->willReturn($uri);

        $middleware = $this->getTestMiddleware($testResponse, Dispatcher::METHOD_NOT_ALLOWED);

        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
          ->getMock();

        $this->expectException(MethodNotAllowedException::class);
        $response = $middleware->process($request, $handler);
    }

    public function testRouteNotFound()
    {
        $testResponse = $this->getMockBuilder(ResponseInterface::class)
          ->getMock();

        $uri = $this->getMockBuilder(UriInterface::class)
          ->getMock();

        $request = $this->getMockBuilder(ServerRequestInterface::class)
          ->getMock();
        $request->method('getUri')->willReturn($uri);

        $middleware = $this->getTestMiddleware($testResponse, Dispatcher::NOT_FOUND);

        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
          ->getMock();

        $this->expectException(NotFoundException::class);
        $response = $middleware->process($request, $handler);
    }

    public function testSimpleRoute()
    {
        $testResponse = $this->getMockBuilder(ResponseInterface::class)
          ->getMock();

        $uri = $this->getMockBuilder(UriInterface::class)
          ->getMock();

        $request = $this->getMockBuilder(ServerRequestInterface::class)
          ->getMock();
        $request->method('getUri')->willReturn($uri);

        $middleware = $this->getTestMiddleware($testResponse);

        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
          ->getMock();
        $response = $middleware->process($request, $handler);

        $this->assertEquals($response, $testResponse);
    }

    private function getTestMiddleware($testResponse, $status = Dispatcher::FOUND)
    {
        $handler = $this->getMockBuilder(RequestHandlerInterface::class)
          ->getMock();
        $handler->method('handle')->willReturn($testResponse);

        $vars = ['name' => 'Test'];

        $dispatcher = $this->getMockBuilder(Dispatcher::class)
          ->getMock();
        $dispatcher->method('dispatch')
          ->willReturn([$status, $handler, $vars]);

        $invoker = $this->getMockBuilder(InvokerInterface::class)
          ->getMock();
        $invoker->method('call')->willReturn($testResponse);

        return new InvokerRouterMiddleware($dispatcher, $invoker);
    }
}
