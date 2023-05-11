<?php

declare(strict_types=1);

namespace Petweb\Core;

class Controller
{
    function render(string $name, array $context = []): void
    {
        $loader     =   new \Twig\Loader\FilesystemLoader('App/View', dirname(__DIR__));
        $twig       =   new \Twig\Environment($loader);

        echo $twig->render($name . '/' . strtolower($name) . '.html.twig', $context);
    }
}
