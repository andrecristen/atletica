<?php


namespace Pummax\Configuration;


class MenuDefine
{

    public static function getAllMenus()
    {
        return [
            'Banners' => [
                'router' => 'banners',
                'icon' => 'fas fa-images'
            ],
            'Usuários' => [
                'router' => 'usuarios',
                'icon' => 'fas fa-users'
            ],
        ];
    }

}