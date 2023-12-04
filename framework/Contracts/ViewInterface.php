<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface ViewInterface
{
    public function render(string $name, array $data = []): void;
}