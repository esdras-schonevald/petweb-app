<?php

declare(strict_types=1);

namespace Petweb\Infra\Core;

class Controller
{
    /**
     * Render the requested page
     *
     * @param string $name Name of the page
     * @param array $context Variables to be consumed on the page presentation layer
     * @return void
     */
    function render(string $name, array $context = []): void
    {
        $loader     =   new \Twig\Loader\FilesystemLoader(['App/View', 'App/View/Adm'], __DIR__ . '/../../');
        $twig       =   new \Twig\Environment($loader);

        echo $twig->render($name . '/' . strtolower($name) . '.html.twig', $context);
    }
}
