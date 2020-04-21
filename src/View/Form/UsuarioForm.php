<?php


namespace View\Form;


use Pummax\View\Form\AbstractForm;

class UsuarioForm extends AbstractForm
{

    public function createHtml()
    {
        return '
        <div class="form-horizontal">
            <fieldset>
                <legend>Acesso ao sistema</legend>
                <div class="form-group">
                    <label for="id">#ID</label>
                    <input ng-required="true" ng-model="data.id" type="number" ng-disabled="true" class="form-control" id="id" >
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input ng-required="true" ng-model="data.login" type="email" class="form-control" id="login" >
                </div>
                <div ng-if="!data.id" class="form-group">
                    <label for="senha">Senha</label>
                    <input ng-required="true" ng-model="data.senha" type="password" class="form-control" id="senha" >
                </div>
            </fieldset>
            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="form-group">
                    <label for="pessoa.nome">Nome</label>
                    <input ng-required="true" ng-model="data.pessoa.nome" type="text" class="form-control" id="nome" >
                </div>
                <div class="form-group">
                    <label for="pessoa.sobrenome">Sobrenome</label>
                    <input ng-required="true" ng-model="data.pessoa.sobrenome" type="text" class="form-control" id="pessoa.sobrenome" >
                </div>
                <div class="form-group">
                    <label for="pessoa.cpf">CPF</label>
                    <input ng-required="true" ng-model="data.pessoa.cpf" type="text" class="form-control" id="cpf" >
                </div>
                <div class="form-group">
                    <label for="pessoa.dataNascimento">Data Nascimento</label>
                    <input ng-required="true" ng-model="data.pessoa.dataNascimento" type="date" class="form-control" id="pessoa.dataNascimento">
                </div>
            </fieldset>
           
        </div>';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'login',
            'senha',
            'pessoa' => [
                'nome',
                'sobrenome',
                'cpf',
                'dataNascimento',
            ]
        ];
    }

    public function getFormName()
    {
        return 'form_usuario';
    }
}