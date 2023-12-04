<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Framework\Container\Container;
use Framework\Contracts\DatabaseInterface;
use Framework\Contracts\RequestInterface;
use Framework\Contracts\RouterInterface;
use Framework\Contracts\ValidatorInterface;
use Framework\Contracts\ViewInterface;
use Framework\Database\Database;
use Framework\Http\Kernel;
use Framework\Http\Request;
use Framework\Router\Router;
use Framework\Validator\Validator;
use Framework\View\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

define("APP_PATH", dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(APP_PATH);
$dotenv->safeLoad();

$container = new Container();

$loader = new FilesystemLoader(APP_PATH . '/views');
$twig = new Environment($loader);

$container->bind(RequestInterface::class, Request::capture());
$container->bind(RouterInterface::class, new Router($container));
$container->bind(DatabaseInterface::class, new Database());
$container->bind(ViewInterface::class, new View($twig));
$container->bind(ValidatorInterface::class, new Validator());

$kernel = new Kernel($container);

$kernel->run();
