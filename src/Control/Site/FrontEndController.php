<?php


namespace Control\Site;


use Pummax\Controller\BaseController;

use View\Site\FrontEndCarteirinha;
use View\Site\FrontEndIndexView;
use View\Site\FrontEndAbout;
use View\Site\FrontEndParceiros;
use View\Site\FrontEndProfile;

class FrontEndController extends BaseController
{

    public function index(){
        return new FrontEndIndexView();
    }

    public function about(){
        return new FrontEndAbout();
    }

    public function profile(){
        return new FrontEndProfile();
    }

    public function carteira(){
        return new FrontEndCarteirinha();
    }

    public function parceiros(){
        return new FrontEndParceiros();
    }


}