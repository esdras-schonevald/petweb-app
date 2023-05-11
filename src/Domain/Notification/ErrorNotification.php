<?php

declare(strict_types=1);

namespace Petweb\Domain\Notification;

use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;

class ErrorNotification implements NotificationInterface
{

    public function __construct(
        private readonly Message $message,
        private readonly Title $title = new Title('Error')
    ) {
    }

    public function getMessage(): string
    {
        return (string) $this->message;
    }

    public function getTitle(): string
    {
        return (string) $this->title;
    }

    public function getType(): string
    {
        return 'Error';
    }
}
