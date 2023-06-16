<?php

declare(strict_types=1);

namespace Petweb\App\Model;

class CatalogoProdutos
{
    public function naoLogado(): void
    {
        echo '<a href="src\App\View\NaoLogado" >Voltar<a>';
    }
}
