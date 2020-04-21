<?php


namespace Pummax\Configuration;


class MenuDefine
{

    public static function getAllMenus()
    {
        return [
            'Carteiras' => [
                'router' => 'carteiras',
                'icon' => 'far fa-id-card'
            ],
            'Banners' => [
                'router' => 'banners',
                'icon' => 'fas fa-images'
            ],
            'Usuários' => [
                'router' => 'usuarios',
                'icon' => 'fas fa-users'
            ],
            'Cursos' => [
                'router' => 'cursos',
                'icon' => 'fas fa-book'
            ],
            'Parceiros' => [
                'router' => 'parceiros',
                'icon' => 'fas fa-handshake'
            ],
        ];
    }

}