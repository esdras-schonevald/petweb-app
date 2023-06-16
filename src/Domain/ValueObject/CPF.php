<?php

declare(strict_types=1);

namespace Petweb\Domain\ValueObject;

use Petweb\Domain\ValueObject\Exception\ValueObjectException;

class CPF implements \Stringable
{
    public function __construct(protected string $cpf)
    {
        $this->cpf    =   preg_replace('/\D/', '', $this->cpf);

        if (!$this->isValid()) {
            throw new ValueObjectException('Invalid CPF');
        }
    }

    protected function isValid(): bool
    {
        if (strlen($this->cpf) != 11) {
            return false;
        }

        // is equals sequence. E.g.: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $this->cpf)) {
            return false;
        }

        for ($base = 9; $base < 11; $base++) {
            for ($sum = 0, $pos = 0; $pos < $base; $pos++) {
                $sum += $this->cpf[$pos] * (($base + 1) - $pos);
            }
            $digit = ((10 * $sum) % 11) % 10;
            if ($this->cpf[$pos] != $digit) {
                return false;
            }
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }

    public function format(): string|null
    {
        return preg_replace('/^([\d]{3})([\d]{3})([\d]{3})([\d]{2})$/', '$1.$2.$3-$4', $this->cpf);
    }
}
