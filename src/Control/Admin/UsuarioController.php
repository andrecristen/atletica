<?php
/**
 * Criado: Fernando Cristen
 * Data: 14/08/2019
 * Hora: 17:15
 */

namespace Control\Admin;


use Pummax\Controller\BaseController;
use Pummax\Model\Mensagem;
use Pummax\Model\Resposta;
use Model\Noticia;
use Model\NoticiaImagem;
use Model\Tema;
use Model\Usuario;
use View\Admin\NoticiaForm;
use View\Admin\UsuarioForm;

class UsuarioController extends BaseController
{

    public function index(){
        $fields = [
            'id' => '#',
            'login' => 'Login',
        ];
        $acoesLinhas = [
            'Editar' => 'editUsuario',
            'Visualizar' => 'viewUsuario',
            'Excluir' => 'deleteUsuario',
        ];
        $acoes = [
            'Adicionar' => 'addUsuario',
        ];
        $dados = $this->modeloParaGrid();
        $resposta = new Resposta($fields, $dados, $acoesLinhas, $acoes);
        $resposta->getFormatoJSON();
    }

    public function modeloParaGrid(){
        $dados = [];
        /** @var $usuarios Usuario[]*/
        $usuarios = $this->getEntityManager()->getRepository(Usuario::class)->findAll();
        foreach ($usuarios as $usuario){
            $dados[] = [
                'id' => $usuario->getId(),
                'login' =>  $usuario->getLogin(),
            ];
        }
        return $dados;
    }

    public function delete(){
        try{
           $usuario = $this->getEntityManager()->getRepository(Usuario::class)->find($this->getResquestParam('id'));
           if($usuario) {
               $this->getEntityManager()->remove($usuario);
               $this->getEntityManager()->flush();
               echo json_encode(['message' => 'Excluido entidade #'.$this->getResquestParam('id')]) ;
               //Excluio o usuario logado?
               if($usuario->getId() == $this->getUserSession()->getId()){
                   //Sai do sistema
                   $backendController = new BackEndController();
                   $backendController->logout();
               }
               return;
           }
        }catch (\Exception $exception){
            echo json_encode(['message' => 'Erro ao excluir entidade, tente novamente']);
        }
    }

    public function add(){
        if($this->isPost()){
            try{
                $usuario = new Usuario();
                $usuario->setLogin($this->getDataParam('login'));
                $senha = $this->getDataParam('senha');
                $confirmarSenha = $this->getDataParam('confirmarSenha');
                if($senha != $confirmarSenha){
                    throw new \Exception("Senhas não são iguais");
                }
                $usuario->setLogin($this->getDataParam('login'));
                $usuario->setSenha($senha);
                $this->getEntityManager()->persist($usuario);
                $this->getEntityManager()->flush();
                new Mensagem(Mensagem::TIPO_SUCESSO, 'Sucesso ao adicionar usuário');
                $this->redirectPage("/admin");
            }catch (\Exception $exception){
                new Mensagem(Mensagem::TIPO_ERRO, 'Erro ao adicionar usuário: '.$exception->getMessage());
                $this->redirectPage("/admin");
            }
        }else{
            $view = new UsuarioForm('/addUsuario', false, false);
            $view->getFormatoJSON();
        }
    }

    public function edit(){
        if($this->isPost()){
            try{
                $usuario = $this->getEntityManager()->getRepository(Usuario::class)->find($this->getDataParam('id'));
                $senha = $this->getDataParam('senha');
                $confirmarSenha = $this->getDataParam('confirmarSenha');
                if($senha != $confirmarSenha){
                    throw new \Exception("Senhas não são iguais");
                }
                $usuario->setLogin($this->getDataParam('login'));
                $usuario->setSenha($senha);
                $this->getEntityManager()->persist($usuario);
                $this->getEntityManager()->flush();
                new Mensagem(Mensagem::TIPO_SUCESSO, 'Sucesso ao alterar usuário');
                $this->redirectPage("/admin");
            }catch (\Exception $exception){
                new Mensagem(Mensagem::TIPO_ERRO, 'Erro ao alterar usuário: '.$exception->getMessage());
                $this->redirectPage("/admin");
            }
        }else{
            $usuario = $this->getEntityManager()->getRepository(Usuario::class)->find($this->getResquestParam('id'));
            $view = new UsuarioForm('/editUsuario', false, true);
            $view->setDados($this->modeloParaForm($usuario));
            $view->getFormatoJSON();
        }
    }

    public function view(){
        $usuario = $this->getEntityManager()->getRepository(Usuario::class)->find($this->getResquestParam('id'));
        $view = new UsuarioForm('/viewUsuario', true, false);
        $view->setDados($this->modeloParaForm($usuario));
        $view->getFormatoJSON();
    }

    public function modeloParaForm(Usuario $usuario){
        $dado = [
            'id' => $usuario->getId(),
            'login' =>  $usuario->getLogin(),
        ];
        return $dado;
    }

}