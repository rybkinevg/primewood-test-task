<?php

declare(strict_types=1);

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    require_once __DIR__ . '/public/index.php';
}