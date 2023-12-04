<?php

declare(strict_types=1);

namespace Framework\Validator\Rules;

interface RuleInterface
{
    public function apply(array $data, string $key);
}