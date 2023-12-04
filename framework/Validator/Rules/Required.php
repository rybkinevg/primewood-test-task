<?php

declare(strict_types=1);

namespace Framework\Validator\Rules;

class Required implements RuleInterface
{
    public static function make(): static
    {
        return new self();
    }

    public function apply(array $data, string $key): ?string
    {
        if (!empty($data[$key])) {
            return null;
        }

        return "Field [$key] requires a value";
    }
}