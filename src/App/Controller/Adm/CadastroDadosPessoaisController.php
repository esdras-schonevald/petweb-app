<?php

declare(strict_types=1);

namespace Petweb\App\Controller\Adm;

use Petweb\Core\Controller;
use Phprise\Routing\Route;

class CadastroDadosPessoaisController extends Controller
{
    #[Route('/adm/cadastro/dados-pessoais', methods: ['GET'])]
    public function index()
    {
        return $this->render('CadastroDadosPessoais');
    }

    #[Route(path: '/adm/cadastro/dados-pessoais', methods: ['POST'])]
    public function create()
    {
        return $this->render('CadastroDadosPessoais');
    }
}
