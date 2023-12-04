# PrimeWood Test Task

## Requirements

- PHP 8.2
- MySQL 8
- Composer

## Installation

- Install composer dependencies:

```shell
composer install
```

- Create the `.env` file from sample:

```shell
cp .env.example .env
```

- Configure database connection in the `.env` file

- Import SQL dump from `database/dump.sql`

- Configure the web server OR run the PHP local server via:

```shell
php -S 127.0.0.1:8001 server.php
```