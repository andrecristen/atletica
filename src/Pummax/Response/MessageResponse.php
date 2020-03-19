<?php


namespace Pummax\Response;


use Pummax\Util\Json;

class MessageResponse extends BaseResponse
{
    const TIPO_SUCCESS = 'success';
    const TIPO_ERRO = 'error';
    const TIPO_CONFIRM = 'confirm';
    const TIPO_INFO = 'info';

    protected $success;

    protected $message;

    protected $typeMessage;

    /**
     * MessageResponse constructor.
     * @param $success
     * @param $message
     * @param $typeMesage
     */
    public function __construct($success, $message, $typeMesage = null)
    {
        if(!$typeMesage){
            if($success){
                $typeMesage = self::TIPO_SUCCESS;
            }else{
                $typeMesage = self::TIPO_ERRO;
            }
        }
        $this->type = self::TYPE_MESSAGE;
        $this->typeMessage = $typeMesage;
        $this->success = $success;
        $this->message = $message;
    }


    public function getJsonFormat()
    {
        return Json::encode([
            'success' => $this->getSuccess(),
            'message' => $this->getMessage(),
            'typeMessage' => $this->getTypeMessage(),
            'type' => $this->getType(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param mixed $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getTypeMessage()
    {
        return $this->typeMessage;
    }

    /**
     * @param string $typeMessage
     */
    public function setTypeMessage($typeMessage)
    {
        $this->typeMessage = $typeMessage;
    }


}