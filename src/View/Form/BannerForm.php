<?php


namespace View\Form;


use Pummax\View\Form\AbstractForm;

class BannerForm extends AbstractForm
{
    public function createHtml()
    {
        return '
        <div class="form-horizontal">
            <div class="form-group">
                <label for="id">#ID</label>
                <input ng-required="true" ng-model="data.id" type="number" ng-disabled="true" class="form-control" id="id" >
            </div>
            <div class="form-group">
                <label for="arquivo">Arquivo</label>
                <input ng-required="true" ng-model="data.arquivo" type="file" class="form-control" id="arquivo" >
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input ng-required="true" ng-model="data.nome" type="text" class="form-control" id="nome" >
            </div>
        </div>';
    }

    public function getFormName()
    {
        return 'form_banner';
    }

    public function getDataMapping()
    {
       return [
           'id',
           'titulo',
           'nome',
       ];
    }
}