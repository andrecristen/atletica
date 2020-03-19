<?php
/**
 * Criado: Fernando Cristen
 * Data: 18/11/2019
 * Hora: 21:56
 */

namespace View\Admin;


use Pummax\View\BaseFormView;

class BannerForm extends BaseFormView
{
    public function createHtml() {
        $botao = '';
        if(!$this->getisView()){
            $botao = '<button class="btn btn-lg btn-primary btn-block" type ="submit">Gravar</button>';
        }
        $imagemUpload =
            '<div class="form-group">
                <label>Imagem</label>
                <input accept="image/*" type="file" class="form-control" required name="upload" >
            </div>';
        if($this->getisEdit() || $this->getisView()){
            $imagemUpload = '';
        }
        return '
        <form action="'.$this->getRouter().'" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="id">#</label>
                <input type="text" readonly="readonly" class="form-control" name="id">
            </div>
            <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Ativo</label>
                <select class="form-control" name="ativo" required>
                    <option value="false">Nao</option>
                    <option value="true">Sim</option>
                </select>
            </div>
            '.$imagemUpload.'
            '.$botao.'
        </form>';
    }
}