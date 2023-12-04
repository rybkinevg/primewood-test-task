<?php

declare(strict_types=1);

namespace Framework\Router;

use Framework\Contracts\RequestInterface;
use Framework\Contracts\ResponseInterface;
use Psr\Container\ContainerInterface;

class Router
{
    private array $routes;

    public function __construct(private readonly ContainerInterface $container)
    {
        $this->initRoutes();
    }

    public function dispatch(RequestInterface $request): void
    {
        $route = $this->findRoute($request->uri(), $request->method());

        if (!$route) {
            throw new \Exception('404 - Page not found');
        }

        $action = $route->getAction();

        if (!is_array($action)) {
            call_user_func($action);

            return;
        }

        [$controller, $method] = $action;

        $controller = $this->container->get($controller);

        $result = call_user_func([$controller, $method]);

        if ($result instanceof ResponseInterface) {
            $result->send();
        }
    }

    private function findRoute(string $uri, string $method): ?Route
    {
        if (!isset($this->routes[$method][$uri])) {
            return null;
        }

        return $this->routes[$method][$uri];
    }

    private function initRoutes(): void
    {
        $routes = require_once APP_PATH . '/routes/routes.php';

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }
}