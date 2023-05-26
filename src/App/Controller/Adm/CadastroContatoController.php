<?php

declare(strict_types=1);

namespace Petweb\App\Controller\Adm;

use Petweb\Core\Controller;
use Phprise\Routing\Route;

class CadastroContatoController extends Controller
{
    #[Route('/adm/cadastro/contato')]
    public function index()
    {
        $this->render('CadastroContato');
    }

    #[Route('/adm/cadastro/contato', methods: ['POST'])]
    public function create()
    {
        $this->render('CadastroDadosPessoais');
    }
}
