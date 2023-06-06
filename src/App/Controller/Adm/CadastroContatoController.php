<?php

declare(strict_types=1);

namespace Petweb\App\Controller\Adm;

use Petweb\Infra\Core\Controller;
use Phprise\Routing\Route;

class CadastroContatoController extends Controller
{
    /**
     * @todo registry actions
     *
     * @return void
     */
    #[Route('/adm/cadastro/contato')]
    public function index()
    {
        $this->render('CadastroContato');
    }

    /**
     * @todo registry create action
     *
     * @return void
     */
    #[Route('/adm/cadastro/contato', methods: ['POST'])]
    public function create()
    {
        $this->render('CadastroDadosPessoais');
    }
}
