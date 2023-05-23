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

        $this->render('Home', ['user' => $session->get('user')]);
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

        $session = new Session();
        $user = $login->getUser();
        $session->set('user', $user);

        $this->render('Home', ['user' => $user]);
    }

    #[Route('/notification/{type}/{code}')]
    public function notification(Request $request)
    {
        $type   =   $request->get('type');
        $code   =   $request->get('code');

        [$title, $message] = match ($code) {
            '401'   => [new Title('Sessão expirada'), new Message('Realize o login novamente')],
            '404'   => [new Title('Rota não encontrada'), new Message('Verifique se o caminho digitado é valido')],
            default => [new Title('Ish man!'), new Message('Algo de errado não está certo')]
        };

        $notification = match ($type) {
            'error'     =>  new ErrorNotification($message, $title),
            'warn'      =>  new WarningNotification($message, $title),
            'info'      =>  new InfoNotification($message, $title),
            'success'   =>  new SuccessNotification($message, $title),
            default     =>  new ErrorNotification($message, $title)
        };

        $session = new Session();
        if (!$session->isValid()) {
            return $this->render('Home', ['notifications' => [$notification]]);
        }

        return $this->render('Home', [
            'notifications' => [$notification],
            'user' => $session->get('user')
        ]);
    }

    #[Route('/logout')]
    public function logout()
    {
        $session = new Session();
        $session->destroy();

        header('location: /');
    }

      #[Route('/notification/{error}/{number}')]
    public function notification()
    {
        $error = new ErrorNotification(
            message: new Message('Página não enontrada!'),
            title: new Title('Ish man!')
        );

        $session = new Session();

        if (!$session->isValid()) {
            return $this->render('Home', ['notifications' => [$error]]);
        }

        $this->render('Home', ['notifications' => [$error]]);
    }
}
