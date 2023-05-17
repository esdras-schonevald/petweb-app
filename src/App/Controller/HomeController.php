<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Login;
use Petweb\Core\Controller;
use Petweb\Core\Session;
use Petweb\Domain\Notification\ErrorNotification;
use Petweb\Domain\Notification\InfoNotification;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\Notification\WarningNotification;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\Password;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    #[Route('/')]
    public function index()
    {
        $session = new Session();

        if (!$session->isValid()) {
            return $this->render('Home');
        }

        $this->render('Logado.html.twig');
    }


    #[Route('/login', ['POST'])]
    public function login(Request $request)
    {
        $email      =   $request->request->filter('email', filter: FILTER_VALIDATE_EMAIL);
        $password   =   $request->request->filter('password', filter: FILTER_CALLBACK, options: ['options' => fn ($pass) => md5(sha1($pass))]);

        $login = new Login(
            new Email($email),
            new Password($password)
        );

        if (!$login->validate()) {
            return $this->render('Home', [
                'notifications' => [
                    new ErrorNotification(
                        message: new Message('Usuário e senha inválidos!'),
                        title: new Title('Ish man!')
                    )
                ]
            ]);
        }

        $this->render('Logado', ['user' => $login->getUser()]);

        var_dump(['email' => $email, 'password' => $password]);
    }
}
