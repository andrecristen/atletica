<?php


namespace Pummax\Controller;


use Pummax\Configuration\RouterDefine;
use Pummax\Response\BaseResponse;
use Pummax\Response\MessageResponse;
use Pummax\Util\Json;

class RouterController
{
    private $baseController;

    public function __construct()
    {
        $this->baseController = new BaseController();
        $this->run();
    }

    private function run(){
        try{
            $request = $_REQUEST;
            $router = false;
            if(isset($request['router'])){
                $router = "/".$request['router'];
            }else{
                if(isset($_SERVER["REDIRECT_URL"])){
                    $router = $_SERVER["REDIRECT_URL"];
                }
            }
            $action = false;
            if(isset($request['action'])){
                $action = $request['action'];
            }
            if(empty($router)){
                $router = "/index";
            }
            $routerDefine = new RouterDefine();
            $found = $routerDefine->getRouter($router);
            $routerArray = $found;
            if($found){
                if($found['privilegio'] == RouterDefine::ADMIN_USER){
                    if(!$this->getBaseController()->getUserSession()){
                        ContainerController::pageAcessoNegado();
                        die;
                    }
                }
                $found = explode('.', $found['control']);
                $controller = ContainerController::newController($found[0]);
                if($action){
                    $response = $controller->{$action}();
                }else{
                    $response = $controller->{$found[1]}();
                }
                $this->processResponse($response, $routerArray);
            }else{
                ContainerController::pageNotFound();
            }
        }catch (\Exception $exception){
            $response = new MessageResponse(false, $exception->getMessage());
            $this->processResponse($response, null);
        }
    }

    private function processResponse($response, $router){
        if($response instanceof BaseResponse){
            $json = Json::decode($response->getJsonFormat());
            if($router){
                $json['title'] = $router['title'];
            }
            echo Json::encode($json);
            die;
        }
    }

    /**
     * @return BaseController
     */
    public function getBaseController()
    {
        return $this->baseController;
    }

    /**
     * @param BaseController $baseController
     */
    public function setBaseController($baseController)
    {
        $this->baseController = $baseController;
    }

}