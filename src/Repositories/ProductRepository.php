<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Framework\Contracts\DatabaseInterface;

readonly class ProductRepository
{
    public function __construct(
        private DatabaseInterface $database
    ) {
    }

    public function create(array $data): Product
    {
        $query = 'INSERT INTO `products` (title, price, created_at) VALUES (:title, :price, :created_at)';

        $createdAtDatetime = \DateTime::createFromFormat(Product::DATETIME_FORMAT, $data['created_at']);

        $bindings = [
            ':title' => $data['title'],
            ':price' => (float) $data['price'],
            ':created_at' => $createdAtDatetime->format('Y-m-d H:i:s'),
        ];

        $id = $this->database->insert($query, $bindings);

        return $this->get($id);
    }

    public function get(int $id): Product
    {
        $query = "SELECT * FROM `products` WHERE `id` = $id";

        $data = $this->database->fetch($query);

        if (empty($data)) {
            throw new \Exception("Product with id [$id] does not exist");
        }

        $product = new Product($data['id'], $data['title'], (float) $data['price'], $data['created_at']);

        return $product;
    }

    public function all(): array
    {
        $products = [];

        $query = 'SELECT * FROM `products` ORDER BY `created_at` ASC';

        foreach ($this->database->fetchAll($query) as $productData) {
            $products[] = new Product(
                $productData['id'],
                $productData['title'],
                (float) $productData['price'],
                $productData['created_at']
            );
        }

        return $products;
    }
}