<?php

declare(strict_types=1);

namespace Petweb\Infra\Core;

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
        return !empty($_SESSION['user']);
    }

    function get(string $key)
    {
        if (!isset($_SESSION[$key])) {
            return null;
        }

        return unserialize($_SESSION[$key]);
    }

    function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = serialize($value);
    }

    function getStatus(): int
    {
        return session_status();
    }

    function getId()
    {
        return session_id();
    }

    function destroy()
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        session_destroy();

        return session_write_close();
    }

    function __call(string $method, array $args): mixed
    {
        if (method_exists($this, $method)) {
            return call_user_func([$this, $method], ...$args);
        }

        if (substr($method, 0, 3) == 'get') {
            return call_user_func([$this, 'get'], lcfirst(substr($method, 3)));
        }

        if (substr($method, 0, 3) ==  'set') {
            return call_user_func([$this, 'set'], lcfirst(substr($method, 3)), ...$args);
        }

        throw new \BadMethodCallException('Bad method call', 500);
    }
}
