<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface ResponseInterface
{
    public function send(): void;
}