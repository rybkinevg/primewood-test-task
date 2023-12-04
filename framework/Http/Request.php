<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Contracts\RequestInterface;

readonly class Request implements RequestInterface
{
    protected function __construct(
        public array $get,
        public array $post,
        public array $server,
    ) {
    }

    public static function capture(): static
    {
        // helps with content types other than: application/x-www-form-urlencoded or multipart/form-data
        $_POST = json_decode(file_get_contents('php://input'), true) ?? [];

        return new static($_GET, $_POST, $_SERVER);
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function post(): array
    {
        return $this->post;
    }

    public function get(): array
    {
        return $this->get;
    }

    public function input(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }
}