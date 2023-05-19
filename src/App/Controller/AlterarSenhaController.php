<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Cadastro;
use Petweb\Core\Controller;
use Petweb\Core\Session;
use Phprise\Routing\Route;

class AlterarSenhaController extends Controller
{
    #[Route('/alterarsenha')]
    public function index(): void
    {
        $session = new Session();
        $this->render('AlterarSenha', ['user' => $session->get('user')]); //nome da pasta
    }
}
