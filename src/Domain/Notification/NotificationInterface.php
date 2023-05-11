<?php

declare(strict_types=1);

namespace Petweb\Domain\Notification;

interface NotificationInterface
{
    function getMessage(): string;

    function getTitle(): string;

    function getType(): string;
}
