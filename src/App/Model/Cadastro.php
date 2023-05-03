<?php

declare(strict_types=1);

namespace Petweb\App\Model;

class Cadastro
{
    public function index(): array
    {
        return [
            ['nome' => 'Esdras', 'idade' => 34, 'endereco' => 'Rua CX'],
            ['nome' => 'Rogerio', 'idade' => 52, 'endereco' => 'Rua ABC']
        ];
    }
}
