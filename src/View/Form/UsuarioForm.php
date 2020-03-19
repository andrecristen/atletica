<?php


namespace View\Form;


use Pummax\View\Form\AbstractForm;

class UsuarioForm extends AbstractForm
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
                <label for="login">Login</label>
                <input ng-required="true" ng-model="data.login" type="email" class="form-control" id="login" >
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input ng-required="true" ng-model="data.senha" type="password" class="form-control" id="senha" >
            </div>
        </div>';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'login',
            'senha',
        ];
    }

    public function getFormName()
    {
        return 'form_usuario';
    }
}