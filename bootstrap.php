<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use Phprise\Routing\RouterConfiguration;
use Phprise\Routing\SimpleRouter;

include_once __DIR__ . '/vendor/autoload.php';

try {
    Dotenv::createUnsafeImmutable(__DIR__);
    $config = RouterConfiguration::createFromAttributes(__DIR__ . '/src/App/Controller');
    $router = new SimpleRouter($config);

    $router->execute();
} catch (Throwable $error) {
    header('location: /notification/error/404');
}
