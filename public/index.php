<?php

declare(strict_types=1);

use Phprise\Routing\RouterConfiguration;
use Phprise\Routing\SimpleRouter;

include_once __DIR__ . '/../vendor/autoload.php';

$config = RouterConfiguration::createFromAttributes(__DIR__ . '/../src/App/Controller');

$router = new SimpleRouter($config);

$router->execute();