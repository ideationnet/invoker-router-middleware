<?php

namespace IdNet\InvokerRouterMiddleware;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use IdNet\InvokerRouterMiddleware\Exception\MethodNotAllowedException;
use IdNet\InvokerRouterMiddleware\Exception\NotFoundException;
use Interop\Http\Server\MiddlewareInterface;
use Interop\Http\Server\RequestHandlerInterface;
use Invoker\InvokerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class InvokerRouterMiddleware implements MiddlewareInterface
{
    public static function createDispatcherFromRouteArray($routes)
    {
        return simpleDispatcher(
            function (RouteCollector $collector) use ($routes) {
                foreach ($routes as $route) {
                    call_user_func_array([$collector, 'addRoute'], $route);
                }
                return $collector;
            }
        );
    }

    /** @var \FastRoute\Dispatcher */
    protected $dispatcher;

    /** @var \Invoker\InvokerInterface */
    protected $invoker;

    public function __construct(
        Dispatcher $dispatcher,
        InvokerInterface $invoker
    ) {
        $this->dispatcher = $dispatcher;
        $this->invoker = $invoker;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ) {
        list($action, $vars) = $this->getRoute($request);

        foreach ($vars as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }
        return $this->invoker->call($action, ['request' => $request]);
    }

    private function getRoute(ServerRequestInterface $request)
    {
        $route = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );
        $status = array_shift($route);
        if ($status === Dispatcher::FOUND) {
            return $route;
        }
        if ($status === Dispatcher::METHOD_NOT_ALLOWED) {
            throw new MethodNotAllowedException($request, $route[0]);
        }
        throw new NotFoundException($request);
    }
}
