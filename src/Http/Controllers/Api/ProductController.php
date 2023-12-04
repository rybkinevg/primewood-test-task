<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Framework\Contracts\RequestInterface;
use Framework\Contracts\ValidatorInterface;
use Framework\Http\JsonResponse;
use Framework\Validator\Rules\Datetime;
use Framework\Validator\Rules\Price;
use Framework\Validator\Rules\Required;

readonly class ProductController
{
    public function __construct(
        private RequestInterface $request,
        private ProductRepository $productRepository,
        private ValidatorInterface $validator
    ) {
    }

    public function index(): JsonResponse
    {
        $products = array_map(
            fn(Product $product): array => $product->toArray(),
            $this->productRepository->all()
        );

        return JsonResponse::make(['data' => $products]);
    }

    public function store(): JsonResponse
    {
        $data = $this->request->post();

        $rules = [
            'title' => [Required::make()],
            'price' => [Required::make(), Price::make()],
            'created_at' => [Required::make(), Datetime::make(Product::DATETIME_FORMAT)],
        ];

        if (!$this->validator->validate($data, $rules)) {
            return JsonResponse::make(
                ['errors' => $this->validator->errors()],
                422,
                'Some fields are invalid'
            );
        }

        try {
            $product = $this->productRepository->create($data);
        } catch (Exception $e) {
            return JsonResponse::make(
                [],
                500,
                $e->getMessage()
            );
        }

        return JsonResponse::make(['data' => $product->toArray()], 201);
    }
}