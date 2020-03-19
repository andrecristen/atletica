<?php

namespace View\Admin;


use Pummax\Controller\BaseController;
use Pummax\Model\Mensagem;
use Pummax\View\BaseView;

class LoginFormView extends BaseView
{
    public function createHtml()
    {
        $mensagemErro = Mensagem::getMessageErro();
        ?>
        <style>
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
                padding: 15px!important;
            }
            .col-sm-6{
                padding: 5px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <?= $mensagemErro ?>
                            <br>
                            <h5 class="card-title text-center">Entrar</h5>
                            <img class="center" src="/utils/img/logo2.jpg">
                            <form class="form-signin" role = "form" action="" method="post">
                                <div class="form-label-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Login" required autofocus>
                                </div>
                                <br/>
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
                                </div>
                                <br/>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 float-left">
                                        <a class="btn btn-md btn-danger btn-block" href="/">Cancelar&nbsp;<i class="far fa-window-close"></i></a>
                                    </div>
                                    <div class="col-sm-6 float-right">
                                        <button class="btn btn-md btn-primary btn-block" name="login" type="submit">Entrar&nbsp;<i class="fas fa-sign-in-alt"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}