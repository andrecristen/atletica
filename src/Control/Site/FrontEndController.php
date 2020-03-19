<?php


namespace Control\Site;


use Pummax\Controller\BaseController;

use View\Site\FrontEndIndexView;
use View\Site\FrontEndAbout;

class FrontEndController extends BaseController
{

    public function index(){
        return new FrontEndIndexView();
    }

    public function about(){
        return new FrontEndAbout();
    }

}