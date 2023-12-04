<?php

declare(strict_types=1);

namespace App\Models;

use Framework\Contracts\Arrayable;
use Framework\Contracts\Jsonable;
use Framework\Traits\JsonableTrait;

class Product implements Arrayable, Jsonable
{
    use JsonableTrait;

    public const DATETIME_FORMAT = 'd.m.Y H:i:s';

    public function __construct(
        public int $id,
        public string $title,
        public float $price,
        public string $created_at,
    ) {
    }

    public function toArray(): array
    {
        $createdAtDatetime = \DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'created_at' => $createdAtDatetime->format(self::DATETIME_FORMAT),
        ];
    }
}