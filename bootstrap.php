<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Petweb\Infra\Exception\InvalidPasswordException;
use Phprise\Routing\RouterConfiguration;
use Phprise\Routing\SimpleRouter;

include_once __DIR__ . '/vendor/autoload.php';

/**
 * Bootstrap file.
 * Load configurations and init router
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>
 * @copyright 2023 Petweb
 * [
 *              ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *              ROGÉRIO GONÇALVES RODRIGRES,
 *              LETÍCIA SANTOS OLIVEIRA,
 *              AMANDA DRAVANETE
 * ]
 */

try {
    Dotenv::createUnsafeImmutable(__DIR__)->load();
    $config = RouterConfiguration::createFromAttributes(__DIR__ . '/src/App/Controller');
    $router = new SimpleRouter($config);

    $router->execute();
} catch (InvalidPasswordException $e) {
    header('location: /notification/password/invalid');
} catch (Throwable $error) {
    $code   =   $error->getCode();
    if (!$code) {
        $code = 404;
    }

    header('location: /notification/error/' . $code);
}
