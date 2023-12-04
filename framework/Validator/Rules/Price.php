<?php

declare(strict_types=1);

namespace Framework\Validator\Rules;

class Price implements RuleInterface
{
    public static function make(): static
    {
        return new self();
    }

    public function apply(array $data, string $key): ?string
    {
        if (empty($data[$key])) {
            return null;
        }

        $pattern = '/^\d{1,10}(?:\.\d{1,2})?$/';

        if (preg_match($pattern, $data[$key])) {
            return null;
        }

        return 'Invalid price';
    }
}