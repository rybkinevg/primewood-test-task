<?php

declare(strict_types=1);

namespace Framework\Router;

use Closure;

readonly class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private array | Closure $action,
    ) {
    }

    public static function get(string $uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getAction(): array | Closure
    {
        return $this->action;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}