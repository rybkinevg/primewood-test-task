<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface DatabaseInterface
{
    public function fetch(string $query): array | false;

    public function fetchAll(string $query): array | false;

    public function insert(string $query, array $bindings = []): int;
}