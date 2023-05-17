<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class ImageSource implements \Stringable
{
    public function __construct(private string $imageSource)
    {
        if (!$this->isValid()) {
            throw new ValueObjectException('ImageSource must be a valid image source');
        }
    }

    public function __toString(): string
    {
        return $this->imageSource;
    }

    protected function isValid(): bool
    {
        return (bool) file_exists($_SERVER['DOCUMENT_ROOT'] . $this->imageSource);
    }
}
