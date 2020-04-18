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
            '/editBanner' => [
                'control' => 'Control::Form::BannerFormController.edit',
                'privilegio' => self::ADMIN_USER,
                'title' => 'Alterar Banner'
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
        );
    }
}