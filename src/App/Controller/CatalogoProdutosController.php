<?php

declare(strict_types=1);

namespace Petweb\App\Controller;

use Petweb\App\Model\CatalogoProdutos; #inportando as classes
use Petweb\Infra\Core\Controller; #essa classe não mudar
use Phprise\Routing\Route;  #essa classe não mudar

/**
 * Controls the actions on products catalog page
 *
 * @author Esdras Schonevald <esdraschonevald@gmail.com>, Rogério Rodrigues <rogonrodrigues@gmail.com>
 * @copyright 2023 Petweb
 * [
 *              ADIEL ESDRAS SCHONEVALD TOLENTINO,
 *              ROGÉRIO GONÇALVES RODRIGRES,
 *              LETÍCIA SANTOS OLIVEIRA,
 *              AMANDA DRAVANETE
 * ]
 */
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
