<?php

declare(strict_types=1);

namespace Framework\Traits;

trait JsonableTrait
{
    public function toJson(int $options = 0): string
    {
        $json = json_encode($this->toArray(), $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Could not serialize value');
        }

        return $json;
    }

    abstract public function toArray(): array;
}