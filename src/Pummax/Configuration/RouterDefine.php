<?php


namespace Pummax\Configuration;


class RouterDefine
{

    const ALL_USER = 1;
    const ADMIN_USER = 2;

    public function getRouter($routerName)
    {
        $allRouters = $this->getAllRouters();
        if (isset($allRouters[$routerName])) {
            return $allRouters[$routerName];
        }
        return null;
    }

    public function getAllRouters()
    {
        return Array(
            //----------Site
            '/index' => [
                'control' => 'Control::Site::FrontEndController.index',
                'privilegio' => self::ALL_USER
            ],
            '/about' => [
                'control' => 'Control::Site::FrontEndController.about',
                'privilegio' => self::ALL_USER,
            ],
            '/profile' => [
                'control' => 'Control::Site::FrontEndController.profile',
                'privilegio' => self::ALL_USER,
            ],
            '/carteira' => [
                'control' => 'Control::Site::FrontEndController.carteira',
                'privilegio' => self::ALL_USER,
            ],
            '/partner' => [
                'control' => 'Control::Site::FrontEndController.parceiros',
                'privilegio' => self::ALL_USER,
            ],
            '/api/login' => [
                'control' => 'Control::Site::ApiController.login',
                'privilegio' => self::ALL_USER,
            ],
            //----------Base Admin
            '/admin' => [
                'control' => 'Control::Admin::AdminController.run',
                'privilegio' => self::ADMIN_USER,
            ],
            //----------Admin
            '/login' => [
                'control' => 'Control::Admin::BackEndController.login',
                'privilegio' => self::ALL_USER,
            ],
            '/logout' => [
                'control' => 'Control::Admin::BackEndController.logout',
                'privilegio' => self::ALL_USER,
            ],
            '/usuarios' => [
                'control' => 'Control::Grid::UsuarioGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Usuários',
            ],
            '/addUsuario' => [
                'control' => 'Control::Form::UsuarioFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Incluir Usuário'
            ],
            '/editUsuario' => [
                'control' => 'Control::Form::UsuarioFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Editar Usuário'
            ],
            '/deleteUsuario' => [
                'control' => 'Control::Form::UsuarioFormController.delete',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Excluir Usuário'
            ],
            '/viewUsuario' => [
                'control' => 'Control::Form::UsuarioFormController.view',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Visualizar Usuário'
            ],
            '/banners' => [
                'control' => 'Control::Grid::BannerGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Banners',
            ],
            '/addBanner' => [
                'control' => 'Control::Form::BannerFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Incluir Banner'
            ],
            '/inativarBanner' => [
                'control' => 'Control::Form::BannerFormController.inativar',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Inativar Banner'
            ],
            '/ativarBanner' => [
                'control' => 'Control::Form::BannerFormController.ativar',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Ativar Banner'
            ],
            '/deleteBanner' => [
                'control' => 'Control::Form::BannerFormController.delete',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Excluir Banner'
            ],
            '/viewBanner' => [
                'control' => 'Control::Form::BannerFormController.view',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Visualizar Banner'
            ],
            '/carteiras' => [
                'control' => 'Control::Grid::CarteiraGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Carteiras'
            ],
            '/addCarteira' => [
                'control' => 'Control::Form::CarteiraFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Adicionar Carteira'
            ],
            '/editCarteira' => [
                'control' => 'Control::Form::CarteiraFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Alterar Carteira'
            ],
            '/deleteCarteira' => [
                'control' => 'Control::Form::CarteiraFormController.delete',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Excluir Carteira'
            ],
            '/viewCarteira' => [
                'control' => 'Control::Form::CarteiraFormController.view',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Visualizar Carteira'
            ],
            '/cursos' => [
                'control' => 'Control::Grid::CursoGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Cursos'
            ],
            '/addCurso' => [
                'control' => 'Control::Form::CursoFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Adicionar Curso'
            ],
            '/editCurso' => [
                'control' => 'Control::Form::CursoFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Alterar Curso'
            ],
            '/deleteCurso' => [
                'control' => 'Control::Form::CursoFormController.delete',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Excluir Curso'
            ],
            '/viewCurso' => [
                'control' => 'Control::Form::CursoFormController.view',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Visualizar Curso'
            ],
            '/parceiros' => [
                'control' => 'Control::Grid::ParceiroGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Parceiros'
            ],
            '/addParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Adicionar Parceiro'
            ],
            '/editParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Alterar Parceiro'
            ],
            '/deleteParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.delete',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Excluir Parceiro'
            ],
            '/viewParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.view',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Visualizar Parceiro'
            ],
            '/inativarParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.inativar',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Inativar Parceiro'
            ],
            '/ativarParceiro' => [
                'control' => 'Control::Form::ParceiroFormController.ativar',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Ativar Parceiro'
            ],
            '/configuracoes' => [
                'control' => 'Control::Grid::ConfiguracaoGridController.index',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Configurações'
            ],
            '/addConfiguracao' => [
                'control' => 'Control::Form::ConfiguracaoFormController.add',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Adicionar Configuração'
            ],
            '/editConfiguracao' => [
                'control' => 'Control::Form::ConfiguracaoFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Alterar Configuração'
            ],
        );
    }
}