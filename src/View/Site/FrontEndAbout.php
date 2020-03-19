<?php

namespace View\Site;

use Pummax\View\BaseView;
use Pummax\View\Facilitador;

class FrontEndAbout extends BaseView
{

    public function createHtml()
    {
        Facilitador::createMenuSite();
    }
}