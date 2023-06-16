<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Phprise\Routing\Route;
use Petweb\App\Model\Cadastro;
use Petweb\Domain\Entity\User;
use Petweb\Infra\Core\Session;
use Petweb\Infra\Core\Controller;
use Petweb\Domain\ValueObject\CPF;
use Petweb\Domain\ValueObject\Name;
use Petweb\App\Model\CadastroCliente;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\ValueObject\Password;
use Petweb\Domain\ValueObject\Telephone;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Infra\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

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
    /**
     *Access page for customer register 
     * @return void
     */
    #[Route('/cadastrocliente', ['GET'])]
    public function index(): void
    {
        $this->render('CadastroCliente');
    }


/**
 *Route send the  customer register
 * @param [type] $request
 * @return void
 */
    #[Route('/cadastrocliente/enviar', ['POST'])]
    public function enviar(Request $request): void
    {
        $model      =   new CadastroCliente();
        $user       =   $model->save($request);

        $session    =   new Session();
        $session->setUser($user);

        $notification   =   new SuccessNotification(
            new Message('Yup! Usuário cadastrado com sucesso'),
            new Title('AU-AU')
        );

        $request->request->filter('address');
        $request->request->filter('bairro');
        $request->request->filter('cidade');
        $request->request->filter('estado');
        $request->request->filter('cep');

        $this->render('CadastroCliente', [
            'notifications' =>  [$notification],
            'user'          =>  $user
        ]);
    }
}
