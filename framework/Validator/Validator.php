<?php

declare(strict_types=1);

namespace Framework\Validator;

use Framework\Contracts\ValidatorInterface;
use Framework\Validator\Rules\RuleInterface;

class Validator implements ValidatorInterface
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];

        foreach ($rules as $key => $rule) {
            $rulesToApply = is_array($rule) ? $rule : [$rule];

            $errors = $this->applyRules($rulesToApply, $data, $key);

            $this->errors[$key] = $errors ?: null;
        }

        return empty($this->errors());
    }

    public function errors(): array
    {
        $errors = array_filter($this->errors);

        return array_map('array_values', $errors);
    }

    private function applyRules(array $rules, array $data, string $key): array
    {
        $errors = array_map(
            function (RuleInterface $rule) use ($data, $key) {
                return $rule->apply($data, $key);
            },
            $rules
        );

        return array_filter($errors);
    }
}