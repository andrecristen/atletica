<?php


namespace View\Form;


use Model\Curso;
use Pummax\View\Form\AbstractForm;
use Repository\CursoRepository;

class CarteiraForm extends AbstractForm
{
    public function defineAtributes()
    {
     $this->setMaximized(true);
     /** @var $cursoRep CursoRepository*/
     $cursoRep = $this->getEntityManager()->getRepository(Curso::class);
     $this->addScopeData('cursoList', $cursoRep->getList());
    }

    public function createHtml()
    {
        return '
        <div class="form-horizontal">
            <div class="form-group">
                <label for="id">#ID</label>
                <input ng-required="true" ng-model="data.id" type="number" ng-disabled="true" class="form-control" id="id" >
            </div>
            <div class="form-group">
                    <label for="dataVencimento">Data Vencimento</label>
                    <input ng-required="true" ng-model="data.dataVencimento" type="date" class="form-control" id="dataVencimento">
                </div>
            <div class="form-group">
                <label for="curso">Curso</label>
                <select ng-model="data.curso" ng-options="curso.id as curso.nome for curso in cursoList track by curso.id" class="form-control select-pummax" id="curso"></select>
            </div>
            <fieldset>
                <legend>Acesso ao sistema</legend>
                <div ng-show="false" class="form-group">
                    <label for="usuario.id">#ID</label>
                    <input ng-required="true" ng-model="data.usuario.id" type="number" ng-disabled="true" class="form-control" id="usuario.id" >
                </div>
                <div class="form-group">
                    <label for="usuario.login">Login</label>
                    <input ng-required="true" ng-model="data.usuario.login" type="email" class="form-control" id="usuario.login" >
                </div>
            </fieldset>
            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="form-group">
                    <label for="pessoa.nome">Nome</label>
                    <input ng-required="true" ng-model="data.usuario.pessoa.nome" type="text" class="form-control" id="nome" >
                </div>
                <div class="form-group">
                    <label for="pessoa.sobrenome">Sobrenome</label>
                    <input ng-required="true" ng-model="data.usuario.pessoa.sobrenome" type="text" class="form-control" id="pessoa.sobrenome" >
                </div>
                <div class="form-group">
                    <label for="pessoa.cpf">CPF</label>
                    <input ng-required="true" ng-model="data.usuario.pessoa.cpf" type="text" class="form-control" id="cpf" >
                </div>
                <div class="form-group">
                    <label for="pessoa.dataNascimento">Data Nascimento</label>
                    <input ng-required="true" ng-model="data.usuario.pessoa.dataNascimento" type="date" class="form-control" id="pessoa.dataNascimento">
                </div>
            </div>
            </fieldset>
            <fieldset>
                <legend>Identificação</legend>
                <div ng-if="data.imagem.id" class="form-group">
                    <label for="arquivo">Imagem Atual</label>
                    <img src="utils{{data.imagem.patch}}">
                </div>
                <div class="form-group">
                    <label ng-if="data.imagem.id" for="arquivo">Alterar Imagem</label>
                    <label ng-if="!data.imagem.id" for="arquivo">Imagem</label>
                    <input ng-required="!data.imagem.id" ng-model="data.arquivo" type="file" class="form-control" id="arquivo" >
                </div>
            </fieldset>    
        </div>';
    }

    public function getFormName()
    {
        return 'form_carteira';
    }

    public function getDataMapping()
    {
        return [
            'id',
            'dataVencimento',
            'usuario' => [
                'id',
                'login',
                'pessoa' => [
                    'nome',
                    'sobrenome',
                    'cpf',
                    'dataNascimento',
                ]
            ],
            'curso' => [
                'id',
                'nome'
            ],
            'imagem' => [
                'id',
                'patch'
            ],
        ];
    }

}