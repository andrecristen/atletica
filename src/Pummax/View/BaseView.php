<?php

namespace Pummax\View;


use Pummax\Configuration\DataBase;
use Pummax\Controller\BaseController;

abstract class BaseView extends BaseController
{
    public function __construct($createMenu = true, $createFooter = true)
    {
        parent::__construct();
        $cache = "?v=10-08-2020-1";
        ?>
        <html lang="pt" class="translated-ltr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">
            <title><?= DataBase::NOME_SISTEMA?></title>
            <link href="utils/css/site.css<?=$cache?>" rel="stylesheet">
            <link href="utils/css/bootstrap.min.css<?=$cache?>" rel="stylesheet">
            <link href="utils/css/fontawesome.css<?=$cache?>" rel="stylesheet">
            <script src="utils/js/jquery.min.js<?=$cache?>"></script>
            <script src="utils/js/bootstrap.js<?=$cache?>"></script>
            <script src="utils/js/fontawesome.min.js<?=$cache?>"></script>
        </head>
        <body>
        <?php
        if($createMenu){
            Facilitador::createMenuSite();
        }
        ?>
        <div style="margin-top: 80px;" class="container-fluid">
            <?php  $this->createHtml(); ?>
        </div>
        <?php
        if($createFooter){
            Facilitador::createFooterSite();
        }
        ?>
        </body>
        </html>
        <?php
    }

    abstract function createHtml();
}