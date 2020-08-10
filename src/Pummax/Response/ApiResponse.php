<?php


namespace Pummax\Response;


use Pummax\Util\Json;

class ApiResponse extends BaseResponse
{
    protected $success;

    protected $message;

    protected $response;

    /**
     * ApiResponse constructor.
     * @param $success
     * @param $message
     * @param $response
     */
    public function __construct($success, $message, $response = [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->response = $response;
    }


    public function getJsonFormat()
    {
        return Json::encode([
            'success' => $this->getSuccess(),
            'message' => $this->getMessage(),
            'response' => $this->getResponse(),
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
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}