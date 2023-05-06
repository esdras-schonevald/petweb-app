<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\Login;
use Petweb\Core\Controller;
use Petweb\Core\Session;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    #[Route('/')]
    public function index()
    {
        $session = new Session();

        if (!$session->isValid()) {
            return $this->render('NaoLogado.html.twig');
        }

        $this->render('Logado.html.twig');
    }


    #[Route('/login', ['POST'])]
    public function login(Request $request)
    {
        $email      =   $request->request->filter('email', filter: FILTER_VALIDATE_EMAIL);
        $password   =   $request->request->filter('password', filter: FILTER_CALLBACK, options: ['options' => fn ($pass) => md5(sha1($pass))]);

        $login = new Login($email, $password);
        if (!$login->validate()) {
            echo "<h1>Usuário e/ou senha inválidos</h1><p>email: $email</p><p>pass: $password</p>";
            return $this->render('NaoLogado.html.twig');
        }

        $this->render('Logado.html.twig');

        var_dump(['email' => $email, 'password' => $password]);
    }
}
