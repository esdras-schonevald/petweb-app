<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\Core\Controller;
use Petweb\Core\Session;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\ValueObject\Password;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class AlterarSenhaController extends Controller
{
    #[Route('/alterarsenha')]
    public function index(): void
    {
        $session = new Session();
        if (!$session->isValid()) {
            header('location: /notification/error/401');
        }

        $this->render('AlterarSenha', ['user' => $session->get('user')]); //nome da pasta
    }

    #[Route('/alterarsenha', ['POST'])]
    public function changePassword(Request $request)
    {
        $oldPass =  new Password(
            $request->request->filter('oldPassword', filter: FILTER_CALLBACK, options: [
                'options' => fn ($pass) => md5(sha1($pass))
            ])
        );

        $newPass =  Password::create($request->request->get('newPassword'));

        $session = new Session();
        if (!$session->isValid()) {
            header('location: /notification/error/401');
        }

        $notification = new SuccessNotification(
            new Message('Senha atualizada com sucesso'),
            new Title('Yup!')
        );

        return $this->render('AlterarSenha', [
            'user' => $session->get('user'),
            'notifications' => [$notification]
        ]);
    }
}
