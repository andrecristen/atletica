<?php
/**
 * Criado: Fernando Cristen
 * Data: 28/10/2019
 * Hora: 18:16
 */

namespace View\Admin;

use Pummax\View\BaseFormView;

class GremioForm extends BaseFormView
{
    public function createHtml()
    {
        $botao = '';
        if (!$this->getisView()) {
            $botao = '<button class="btn btn-lg btn-primary btn-block" type ="submit">Gravar</button>';
        }
        return '
        <script src="utils/js/editor.js"></script>
        <div class="alert alert-info">
            <strong>Atenção!</strong>
            <br>
            <span>Certifique-se de manter apenas uma das entidade do grêmio como ativa.</span>
        </div>
        <script src="utils/js/editor.js"></script>
        <form action="' . $this->getRouter() . '" method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">#</label>
                <input readonly="readonly" type="text" class="form-control" name="id" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Chapa</label>
                <input type="text" class="form-control" name="chapa" required>
            </div>
             <div class="form-group">
                <label>Sobre Nós</label>
                <textarea class="form-control" name="descricao" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Gremio Atual?</label>
                <select class="form-control" name="atual" required>
                    <option value="false">Nao</option>
                    <option value="true">Sim</option>
                </select>
            </div>            
            ' . $botao . '
        </form>
        <script>
            $(document).ready(function () {
                nicEditors.allTextAreas()
            });
        </script>';
    }
}
?>