<?php

declare(strict_types=1);

namespace Petweb\Core;

class Session
{
    function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    function isValid(): bool
    {
        return !empty($_SESSION['email']);
    }

    function get(string $key)
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }

        return $_SESSION[$key];
    }

    function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }
}
