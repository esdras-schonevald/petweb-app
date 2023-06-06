<?php

declare(strict_types=1);

namespace Petweb\Domain\Entity;

use Petweb\Domain\ValueObject\CPF;
use Petweb\Domain\ValueObject\Email;
use Petweb\Domain\ValueObject\ImageSource;
use Petweb\Domain\ValueObject\Name;
use Petweb\Domain\ValueObject\Password;
use Petweb\Domain\ValueObject\Telephone;
use Petweb\Domain\ValueObject\UserGroup;

class User implements \JsonSerializable
{
    public function __construct(
        public readonly int $id,
        public readonly Name $name,
        public readonly Email $email,
        public readonly Password $password,
        public readonly UserGroup $userGroup,
        public readonly int $accountId,
        public readonly ?Telephone $telephone = null,
        public readonly ?CPF $cpf = null,
        public readonly ?ImageSource $image = null
    ) {
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromJson(string $json): self
    {
        $user = json_decode($json);

        return new self(
            intval($user->id),
            new Name($user->name),
            new Email($user->email),
            new Password($user->password),
            new UserGroup($user->userGroup),
            intval($user->accountId),
            $user->telephone ? new Telephone($user->telephone) : null,
            $user->cpf ? new CPF($user->cpf) : null,
            $user->image ? new ImageSource($user->image) : null
        );
    }

    public function jsonSerialize(): object
    {
        return (object)[
            'id'            =>  $this->id,
            'name'          =>  $this->name->__toString(),
            'email'         =>  $this->email->__toString(),
            'password'      =>  $this->password->__toString(),
            'userGroup'     =>  $this->userGroup->__toString(),
            'accountId'     =>  $this->accountId,
            'telephone'     =>  $this->telephone?->__toString(),
            'cpf'           =>  $this->cpf?->__toString(),
            'image'         =>  $this->image?->__toString()
        ];
    }
}
