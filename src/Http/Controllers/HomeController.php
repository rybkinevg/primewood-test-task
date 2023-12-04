<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Framework\Contracts\ViewInterface;

readonly class HomeController
{
    public function __construct(
        private ViewInterface $view,
    ) {
    }

    public function index(): void
    {
        $this->view->render('home');
    }
}