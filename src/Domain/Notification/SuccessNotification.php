<?php

declare(strict_types=1);

namespace Petweb\Domain\Notification;

use Petweb\Domain\Notification\ValueObject\Message;
use Petweb\Domain\Notification\ValueObject\Title;

class SuccessNotification implements NotificationInterface
{

    public function __construct(
        private readonly Message $message,
        private readonly Title $title = new Title('Success')
    ) {
    }

    public function getMessage(): string
    {
        return $this->message->__toString();
    }

    public function getTitle(): string
    {
        return $this->title->__toString();
    }

    public function getType(): string
    {
        return 'Success';
    }
}
