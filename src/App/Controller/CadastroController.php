<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Cadastro;
use Phprise\Routing\Route;

class CadastroController
{
    #[Route('/cadastro')]
    public function index()
    {
        $loader     =   new \Twig\Loader\FilesystemLoader('View', dirname(__DIR__));
        $twig       =   new \Twig\Environment($loader);

        $model = new Cadastro();
        $dados = $model->index();
        echo $twig->render('Cadastro.html.twig', ['data' => $dados]);
    }
}
