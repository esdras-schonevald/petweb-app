<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Cadastro;
use Petweb\Core\Controller;
use Phprise\Routing\Route;

class CadastroController extends Controller
{
    #[Route('/cadastro')]
    public function index(): void
    {
        $model = new Cadastro();
        $dados = $model->index();
        $this->render('Cadastro.html.twig', ['data' => $dados]);
    }
}
