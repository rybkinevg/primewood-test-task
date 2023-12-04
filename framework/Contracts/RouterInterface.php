<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface RouterInterface
{
    public function dispatch(RequestInterface $request): void;
}