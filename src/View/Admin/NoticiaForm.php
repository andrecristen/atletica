<?php
/**
 * Criado: Fernando Cristen
 * Data: 14/08/2019
 * Hora: 16:54
 */

namespace View\Admin;


use Pummax\View\BaseFormView;

class NoticiaForm extends BaseFormView
{

    protected $listaTemas;

    public function __construct($router, $isView = false, $isEdit = false, $listaTemas)
    {
        $this->setListaTemas($listaTemas);
        parent::__construct($router, $isView, $isEdit);
    }

    public function createHtml() {
        $botao = '';
        if(!$this->getisView()){
            $botao = '<button class="btn btn-lg btn-primary btn-block" type ="submit">Gravar</button>';
        }
        $imagem =
           '<div class="form-group">
                <label>Imagem Capa</label>
                <input accept="image/*" type="file" class="form-control" required name="capa" >
            </div>';
        if($this->getisView() || $this->getisEdit()){
            $imagem = '';
        }
        return '
        <script src="utils/js/editor.js"></script>
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
                <label for="titulo">Resumo</label>
                <input maxlength="255" class="form-control" name="resumo" required>
            </div>
            <div class="form-group">
                <label>Conteudo</label>
                <textarea class="form-control" name="corpo" rows="5"></textarea>
            </div>
            '.$imagem.'
            <div class="form-group">
               <label for="tema">Tema</label>
               <select class="form-control" name="tema" required>
               '.$this->geraOpcoesTema().'
               </select>
            </div> 
            '.$botao.'
        </form>
        <script>
            $(document).ready(function () {
                nicEditors.allTextAreas()
            });
        </script>';
    }

    private function geraOpcoesTema(){
        $options = '';
        foreach ($this->getListaTemas() as $tema){
            $options .= '<option value="'.$tema->getId().'">'.$tema->getNome().'</option>';
        }
        return $options;
    }

    /**
     * @return mixed
     */
    public function getListaTemas()
    {
        return $this->listaTemas;
    }

    /**
     * @param mixed $listaTemas
     */
    public function setListaTemas($listaTemas)
    {
        $this->listaTemas = $listaTemas;
    }
}
?>
