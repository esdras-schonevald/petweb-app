<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Cadastro;
use Petweb\Infra\Core\Controller;
use Phprise\Routing\Route;

/**
 * Controls the actions on client registry page
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
class CadastroClienteController extends Controller
{
    #[Route('/cadastrocliente', ['GET'])]
    public function index(): void
    {
        // $model = new Cadastro();
        // $dados = $model->index();
        $this->render('CadastroCliente');
    }

    #[Route('/cadastrocliente/enviar', ['POST'])]
    public function enviar($request): void
    {

        $name = $request->request->filter('name');
        $rg = $request->request->filter('rg');
        $cpf = $request->request->filter('cpf');
        $senha = $request->request->filter('senha');
        $fone = $request->request->filter('fone');
        $email = $request->request->filter('email');
        $address = $request->request->filter('address');
        $bairro = $request->request->filter('bairro');
        $cidade = $request->request->filter('cidade');
        $estado = $request->request->filter('estado');
        $cep = $request->request->filter('cep');

        $this->render('CadastroCliente');
    }
}
