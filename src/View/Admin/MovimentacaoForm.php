<?php
/**
 * Criado: Fernando Cristen
 * Data: 18/11/2019
 * Hora: 01:46
 */

namespace View\Admin;


use Pummax\View\BaseFormView;
use Model\Movimentacao;

class MovimentacaoForm extends BaseFormView
{
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
                <label for="exampleFormControlInput1">Título</label>
                <input type="text" class="form-control" name="titulo" required>
            </div> 
            <div class="form-group">
                <label for="exampleFormControlInput1">Descrição</label>
                <input type="text" class="form-control" name="descricao" required>
            </div> 
            <div class="form-group">
                <label for="exampleFormControlInput1">Tipo</label>
                <select class="form-control" name="tipo" required>
                '.$this->geraOpcoesTipo().'
                </select>
            </div>            
            ' . $botao . '
        </form>';
    }

    private function geraOpcoesTipo(){
        $options = '';
        foreach (Movimentacao::getTipoList() as $tipo => $nome){
            $options .= '<option value="'.$tipo.'">'.$nome.'</option>';
        }
        return $options;
    }
}