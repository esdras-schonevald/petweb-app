<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\AlterarSenha;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\ValueObject\Password;
use Petweb\Infra\Core\Controller;
use Petweb\Infra\Core\Session;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controls the actions of change password page
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>
 * @author Rodrigues <rogonrodrigues@gmail.com>
 * @copyright 2023 Petweb
 * [
 *              ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *              ROGÉRIO GONÇALVES RODRIGRES,
 *              LETÍCIA SANTOS OLIVEIRA,
 *              AMANDA DRAVANETE
 * ]
 */
class AlterarSenhaController extends Controller
{
    /**
     * Load change password page
     *
     * @return void
     */
    #[Route('/alterarsenha')]
    public function index(): void
    {
        $session = new Session();
        if (!$session->isValid()) {
            header('location: /notification/error/401');
        }

        $this->render('AlterarSenha', ['user' => $session->getUser()]); //nome da pasta
    }

    /**
     * Change to new password
     *
     * @param Request $request
     * @return void
     */
    #[Route('/alterarsenha', ['POST'])]
    public function changePassword(Request $request)
    {
        $session = new Session();
        if (!$session->isValid()) {
            header('location: /notification/error/401');
        }

        $user       =   $session->getUser();
        $oldPass    =   new Password(
            $request->request->filter('oldPassword', filter: FILTER_CALLBACK, options: [
                'options' => fn ($pass) => md5(sha1($pass))
            ])
        );
        $newPass    =  Password::create($request->request->get('newPassword'));

        $model      =  new AlterarSenha();
        $model->changePassword($user, $oldPass, $newPass);

        $notification = new SuccessNotification(
            new Message('Yup! Senha atualizada com sucesso'),
            new Title('AU-AU')
        );

        return $this->render('AlterarSenha', [
            'user' => $session->getUser(),
            'notifications' => [$notification]
        ]);
    }
}
