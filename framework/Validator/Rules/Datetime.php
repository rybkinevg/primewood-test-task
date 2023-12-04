<?php

declare(strict_types=1);

namespace Framework\Validator\Rules;

readonly class Datetime implements RuleInterface
{
    public static function make(string $format): static
    {
        return new self($format);
    }

    public function apply(array $data, string $key): ?string
    {
        if (empty($data[$key])) {
            return null;
        }

        if (\DateTime::createFromFormat($this->format, $data[$key]) !== false) {
            return null;
        }

        return 'Invalid date time';
    }

    private function __construct(
        private string $format
    ) {
    }
}