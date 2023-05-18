<?php

declare(strict_types=1);

namespace Petweb\App\Model;

class CadastroPet
{
    public function pets(): array
    {
        return [
            ['nome' => 'JuJuba', 'sexo' => 'F', 'cor' => 'Branca'],
            ['nome' => 'ReX', 'sexo' => 'm', 'cor' => 'Preto'],
            ['nome' => 'Perninha', 'sexo' => 'f', 'cor' => 'Cinza'],
            ['nome' => 'Douradinho', 'sexo' => 'm', 'cor' => 'Dourado']
        ];
    }
    public function cadastrarPet( $pet ): void
    {
        
        
    }

}
