<?php

declare(strict_types=1);

namespace Framework\Database;

use Framework\Contracts\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function fetch(string $query): array | false
    {
        $sth = $this->pdo->prepare($query);

        $sth->execute();

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(string $query): array | false
    {
        $sth = $this->pdo->prepare($query);

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $query, array $bindings = []): int
    {
        $sth = $this->pdo->prepare($query);

        foreach ($bindings as $key => $value) {
            $sth->bindValue($key, $value);
        }

        $sth->execute();

        return (int) $this->pdo->lastInsertId();
    }

    private function connect(): void
    {
        $driver = $_ENV['DATABASE_DRIVER'];
        $host = $_ENV['DATABASE_HOST'];
        $port = $_ENV['DATABASE_PORT'];
        $database = $_ENV['DATABASE_NAME'];
        $username = $_ENV['DATABASE_USERNAME'];
        $password = $_ENV['DATABASE_PASSWORD'];
        $charset = $_ENV['DATABASE_CHARSET'];

        $dsn = "$driver:host=$host;port=$port;dbname=$database;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            exit("Database connection failed: {$e->getMessage()}");
        }
    }
}