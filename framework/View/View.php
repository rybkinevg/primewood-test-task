<?php

declare(strict_types=1);

namespace Framework\View;

use Framework\Contracts\ViewInterface;
use Twig\Environment;

readonly class View implements ViewInterface
{
    public function __construct(
        private Environment $twig
    ) {
    }

    public function render(string $name, array $data = []): void
    {
        echo $this->twig->render("pages/$name.html.twig", array_merge($data, $this->defaultData()));
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
        ];
    }
}