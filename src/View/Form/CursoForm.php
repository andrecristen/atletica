<?php


namespace View\Form;


use Pummax\View\Form\AbstractForm;

class CursoForm extends AbstractForm
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
                <label for="nome">Nome</label>
                <input ng-required="true" ng-model="data.nome" type="text" class="form-control" id="nome" >
            </div>
            <div class="form-group">
                <label for="ativo">Ativo</label>
                <input ng-model="data.ativo" type="checkbox" class="form-control" id="ativo" >
            </div>
        </div>';
    }

    public function getFormName()
    {
        return 'form_curso';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'ativo',
            'nome',
        ];
    }
}