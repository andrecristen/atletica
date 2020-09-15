<?php

namespace Pummax\Controller;


use Model\Usuario;
use Pummax\Configuration\DataBase;
use Pummax\DataBase\Connection;
use Pummax\Handler\HandlerException;
use Pummax\Model\Mensagem;
use Pummax\Util\Json;

class BaseController extends HandlerException
{
    private $entityManager;

    public function __construct()
    {
        parent::__construct();
        $this->entityManager = Connection::getEntityManager();
    }

    public function isPost(){
        if (isset($_POST) && count($_POST) > 0){
            return true;
        }
        return false;
    }

    public function getData(){
        return $_POST;
    }

    public function getRequest(){
        return $_REQUEST;
    }

    public function getResquestParam($name){
        $request = $this->getRequest();
        if(isset($request[$name])){
            return $request[$name];
        }
        return null;
    }

    public function getParam($name, $defaultValue = null){
        $request = $this->getRequest();
        if(isset($request['params'][$name])){
            return $request['params'][$name];
        }
        return $defaultValue;
    }

    public function setUserSession($user){
        $this->setOnSession('usuario', $user);
    }

    public function getUserSession(){
        return $this->getOnSession('usuario');
    }

    /**
     * @return Usuario|null
     */
    public function getUserModelSession(){
        $user = $this->getOnSession('usuario');
        if(isset($user[0]['usu_id'])){
            return $this->getEntityManager()->getRepository(Usuario::class)->find($user[0]['usu_id']);
        }
        return null;
    }

    public static function getUserSessionStatic(){
        return self::getOnSession('usuario');
    }

    public function clearUserSession(){
        $this->setOnSession('usuario', false);
    }

    public function getDataParam($name){
        $dados = $this->getData();
        if (isset($dados[$name])){
            $dado = $dados[$name];
            if($dado == 'true'){
                return true;
            }elseif ($dado == 'false'){
                return false;
            }
            return $dado;
        }
        return null;
    }

    public function getRow(){
        $row = $this->getParam('row');
        return $this->formatRowResponse($row);
    }

    public function formatRowResponse($row){
        if(is_array($row)){
            $row = reset($row);
            return $row['data'];
        }
        return null;
    }

    public function getFormData(){
        $request = $this->getRequest();
        return isset($request['formData']) ? Json::decode($request['formData']) : null;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function redirectPage($router, $params = null){
        header("Location: ".DataBase::URL_SITE.$router);
    }

    public static function setOnSession($name, $value){
        $_SESSION[$name] = $value;
    }

    public static function unsetOnSession($name){
        unset($_SESSION[$name]);
    }

    public static function getOnSession($name){
        if (isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
        return null;
    }

    public static function getMessageErro(){
        return self::getOnSession(Mensagem::TIPO_ERRO);
    }

    public static function getMessageSuccess(){
        return self::getOnSession(Mensagem::TIPO_SUCESSO);
    }

    public static function setMessage($tipo, $mensagem){
        self::setOnSession($tipo, $mensagem);
    }
}