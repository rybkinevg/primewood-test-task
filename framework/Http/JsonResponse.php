<?php

declare(strict_types=1);

namespace Framework\Http;

use Framework\Contracts\ResponseInterface;

class JsonResponse implements ResponseInterface
{
    public const STATUS_CODES = [
        200 => '200 OK',
        201 => '200 Created',
        400 => '400 Bad Request',
        422 => '422 Unprocessable Entity',
        500 => '500 Internal Server Error'
    ];

    public static function make(array $data, int $code = 200, ?string $message = null): static
    {
        return new self($data, $code, $message);
    }

    public function send(): void
    {
        $jsonResponse = json_encode(array_merge($this->data, ['message' => $this->message]));

        if (!$jsonResponse) {
            $this->data = [];
            $this->code = 500;
            $this->message = 'Something went wrong, please try again later';

            $this->send();
        }

        header_remove();
        http_response_code($this->code);
        header('Content-Type: application/json');
        header('Status: ' . self::STATUS_CODES[$this->code]);

        die($jsonResponse);
    }

    private function __construct(
        private array $data,
        private int $code,
        private ?string $message
    ) {
    }
}