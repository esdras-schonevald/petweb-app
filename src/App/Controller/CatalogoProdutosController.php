<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\CatalogoProdutos; #inportando as classes
use Petweb\Core\Controller; #essa classe não mudar
use Phprise\Routing\Route;  #essa classe não mudar

class CatalogoProdutosController extends Controller
{
    #[Route('/catalogoprodutos')]
    public function index(): void
    {
       //$model = new  CadastroPet();
        //$dados = $model->pets(); #a função pets veio da  classe CadastroPet
        $this->render('CatalogoProdutos'); #cadastrar past do diretorio
    }
    #[Route('/naologado')]
    public function naoLogado(): void
    {

        $this->render('NaoLogado');
    }
    
}
