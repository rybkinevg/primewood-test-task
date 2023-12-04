<?php

declare(strict_types=1);

namespace Framework\Contracts;

interface ValidatorInterface
{
    public function validate(array $data, array $rules): bool;

    public function errors(): array;
}