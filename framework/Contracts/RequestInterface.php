<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface RequestInterface
{
    public static function capture(): static;

    public function uri(): string;

    public function method(): string;

    public function input(string $key, $default = null): mixed;

    public function post(): array;

    public function get(): array;
}