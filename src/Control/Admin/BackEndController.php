<?php


namespace Control\Admin;


use Pummax\Controller\BaseController;
use Pummax\Model\Mensagem;
use Model\Usuario;
use Repository\UsuarioRepository;
use View\Admin\LoginFormView;

class BackEndController extends BaseController
{

    public function login(){
        if($this->isPost()){
            /** @var $repositorio UsuarioRepository*/
            $repositorio = $this->getEntityManager()->getRepository(Usuario::class);
            $usuario = $repositorio->validaLogin($this->getDataParam("email"), $this->getDataParam("password"));
            if($usuario){
                $this->setUserSession($usuario);
                new Mensagem(Mensagem::TIPO_SUCESSO, 'Login realizado com sucesso.');
                $this->redirectPage("admin");
            }else{
                new Mensagem(Mensagem::TIPO_ERRO, 'Não localizado usuário com informações solicitadas.');
                $this->redirectPage("login");
            }
        }else{
            if($this->getUserSession()){
                $this->redirectPage("admin");
            }
            return new LoginFormView();
        }
    }


    public function logout(){
        $this->clearUserSession();
        $this->redirectPage("index");
    }
}