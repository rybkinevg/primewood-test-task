<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Contracts\RequestInterface;
use Framework\Contracts\RouterInterface;
use Psr\Container\ContainerInterface;

class Kernel
{
    public function __construct(private readonly ContainerInterface $container)
    {
    }

    public function run(): void
    {
        /** @var RouterInterface $router */
        $router = $this->container->get(RouterInterface::class);

        /** @var RequestInterface $request */
        $request = $this->container->get(RequestInterface::class);

        $router->dispatch($request);
    }
}