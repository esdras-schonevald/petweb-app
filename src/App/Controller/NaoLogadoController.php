<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Phprise\Routing\Route;

class NaoLogadoController
{
    #[Route('/')]
    public function index()
    {
        $loader     =   new \Twig\Loader\FilesystemLoader('View', dirname(__DIR__));
        $twig       =   new \Twig\Environment($loader);

        echo $twig->render('NaoLogado.html.twig');
    }
}
