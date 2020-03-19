<?php
/**
 * Criado: Fernando Cristen
 * Data: 03/09/2019
 * Hora: 22:06
 */

namespace View\Admin;

use Pummax\View\BaseFormView;

class IntegranteForm extends BaseFormView
{
    protected $listaGremios;

    public function __construct($router, $isView = false, $listaGremios)
    {
        $this->setListaGremios($listaGremios);
        parent::__construct($router, $isView);
    }

    public function createHtml()
    {
        $botao = '';
        if (!$this->getisView()) {
            $botao = '<button class="btn btn-lg btn-primary btn-block" type ="submit">Gravar</button>';
        }
        return '
        <script src="utils/js/editor.js"></script>
        <form action="' . $this->getRouter() . '" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">#</label>
                <input readonly="readonly" type="text" class="form-control" name="id" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div> 
            <div class="form-group">
                <label for="exampleFormControlInput1">Cargo</label>
                <input type="text" class="form-control" name="cargo" required>
            </div> 
            <div class="form-group">
                <label for="exampleFormControlInput1">Gremio</label>
                <select class="form-control" name="gremio" required>
                '.$this->geraOpcoesGremio().'
                </select>
            </div>            
            ' . $botao . '
        </form>';
    }

    private function geraOpcoesGremio(){
        $options = '';
        foreach ($this->getListaGremios() as $gremio){
            $options .= '<option value="'.$gremio->getId().'">'.$gremio->getNomeChapa().'</option>';
        }
        return $options;
    }

    /**
     * @return mixed
     */
    public function getListaGremios()
    {
        return $this->listaGremios;
    }

    /**
     * @param mixed $listaGremios
     */
    public function setListaGremios($listaGremios)
    {
        $this->listaGremios = $listaGremios;
    }

}