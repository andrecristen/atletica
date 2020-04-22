<?php


namespace Control\Grid;

use Model\Configuracao;
use Pummax\Controller\BaseGridController;
use View\Grid\ConfiguracaoGrid;

class ConfiguracaoGridController extends BaseGridController
{

    public function instanceView()
    {
        return new ConfiguracaoGrid();
    }

    public function instanceRepository()
    {
        return $this->getEntityManager()->getRepository(Configuracao::class);
    }
}