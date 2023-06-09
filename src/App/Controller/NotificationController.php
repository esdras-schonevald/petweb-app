<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\Domain\Notification\ErrorNotification;
use Petweb\Domain\Notification\InfoNotification;
use Petweb\Domain\Notification\SuccessNotification;
use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;
use Petweb\Domain\Notification\WarningNotification;
use Petweb\Infra\Core\Controller;
use Petweb\Infra\Core\Session;
use Phprise\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controls the notifications sendeds
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
class NotificationController extends Controller
{
    /**
     * Send notification when the client input an invalid password
     *
     * @return void
     */
    #[Route('/notification/password/invalid', methods: ['GET'])]
    public function invalidPassword()
    {
        http_response_code(401);
        $notification   =   new ErrorNotification(
            new Message('Não é possível concluir a requisição'),
            new Title('Senha inválida!')
        );

        $session = new Session();
        if (!$session->isValid()) {
            return $this->render('Home', ['notifications' => [$notification]]);
        }

        return $this->render('AlterarSenha', [
            'notifications' =>  [$notification],
            'user'          =>  $session->getUser()
        ]);
    }

    /**
     * Send notifications to client based on error code
     *
     * @param Request $request Automaticaly provide by routing component
     * @return void
     */
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
            'user' => $session->getUser()
        ]);
    }
}
