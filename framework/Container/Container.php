<?php

declare(strict_types=1);

namespace Framework\Container;

use Psr\Container\ContainerInterface;
use ReflectionClass;

class Container implements ContainerInterface
{
    private array $bindings = [];

    public function bind(string $id, object $service): void
    {
        $this->bindings[$id] = $service;
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    public function get(string $id): mixed
    {
        return $this->has($id) ? $this->bindings[$id] : $this->resolve($id);
    }

    private function resolve(string $class): object
    {
        $reflector = new ReflectionClass($class);

        $constructReflector = $reflector->getConstructor();

        if (empty($constructReflector)) {
            return new $class;
        }

        $constructArguments = $constructReflector->getParameters();

        if (empty($constructArguments)) {
            return new $class;
        }

        $args = [];

        foreach ($constructArguments as $argument) {
            $argumentType = $argument->getType()->getName();

            $args[$argument->getName()] = $this->get($argumentType);
        }

        return new $class(...$args);
    }
}