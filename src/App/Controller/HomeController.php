<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Login;
use Petweb\Domain\Notification\ErrorNotification;
use Petweb\Domain\Notification\InfoNotification;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\Notification\WarningNotification;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\Password;
use Petweb\Infra\Core\Controller;
use Petweb\Infra\Core\Session;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controls the actions of home page
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>
 * @author Rogério Rodrigues <rogonrodrigues@gmail.com>
 * @copyright 2023 Petweb
 * [
 *              ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *              ROGÉRIO GONÇALVES RODRIGRES,
 *              LETÍCIA SANTOS OLIVEIRA,
 *              AMANDA DRAVANETE
 * ]
 */
class HomeController extends Controller
{
    /**
     * The first one route in the system.
     *
     * @return void
     */
    #[Route('/')]
    public function index()
    {
        $session = new Session();

        if (!$session->isValid()) {
            return $this->render('Home');
        }

        $this->render('Home', ['user' => $session->getUser()]);
    }


    /**
     * Responsible for login authentication
     *
     * @param Request $request Automticaly injected by routing component
     * @return void
     */
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
                        message: new Message('Ish man! Usuário e senha inválidos!'),
                        title: new Title('GRRRRRR')
                    )
                ]
            ]);
        }

        $session = new Session();
        $user = $login->getUser();
        $session->setUser($user);

        $this->render('Home', ['user' => $user]);
    }

    /**
     * Destroy the client session
     *
     * @return void
     */
    #[Route('/logout')]
    public function logout()
    {
        $session = new Session();
        $session->destroy();

        header('location: /');
    }
}
