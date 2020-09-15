<?php


namespace Pummax\Controller;


abstract class BaseApiController extends BaseController
{

    public function getApiRequest(){
        $request = $this->getRequest();
        if(!$this->validateData($request)){
            $request = $this->getData();
        }
        return $request;
    }

    public function validateData($data){
        if(!$data || (is_array($data) && count($data) == 0)){
            return false;
        }
        return true;
    }
}