<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\CadastroPet; #inportando as classes
use Petweb\Infra\Core\Controller; #essa classe não mudar
use Petweb\Infra\Core\Session;
use Phprise\Routing\Route;  #essa classe não mudar
use Symfony\Component\HttpFoundation\Request;

/**
 * Controls the actions on pet registry page
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>, Rogério Rodrigues <rogonrodrigues@gmail.com>
 * @copyright 2023 Petweb
 * [
 *              ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *              ROGÉRIO GONÇALVES RODRIGRES,
 *              LETÍCIA SANTOS OLIVEIRA,
 *              AMANDA DRAVANETE
 * ]
 */
class CadastroPetController extends Controller
{
    #[Route('/cadastropet')]
    public function index(): void
    {
        $session = new Session();

        if (!$session->isValid()) {
            header('location: /');
        }

        $user = $session->getUser();

        $model = new  CadastroPet();
        $dados = $model->pets(); #a função pets veio da  classe CadastroPet
        $this->render('CadastrarPet', ['pets' => $dados, 'user' => $user]); #cadastrar past do diretorio
    }

    #[Route('/registrarpet', ['POST'])]
    public function cadastrarPet(Request $request): void
    {
        $nome       = $request->request->filter('nome');
        $especie    = $request->request->filter('especie');
        $raca       = $request->request->filter('raca');
        $cor        = $request->request->filter('cor');
        $sexo       = $request->request->filter('sexo');
        $idade      = $request->request->filter('idade');
        $castrado   = $request->request->filter('castrado');

        $model = new  CadastroPet();
        $model->cadastrarPet([$nome, $especie, $raca, $cor, $sexo, $idade, $castrado]); #a função pets veio da  classe CadastroPet
        $dados = $model->pets();
        $dados2 = array_merge($dados, [['nome' => $nome, 'sexo' => $sexo, 'cor' => $cor]]);
        $this->render('CadastrarPet', ['pets' => $dados2]); #cadastrar past do diretorio

    }
}
