<?php


namespace Pummax\Handler;


use Pummax\Configuration\DataBase;
use Pummax\Controller\BaseController;
use Pummax\Response\MessageResponse;

class HandlerException
{

    public function __construct()
    {
        set_exception_handler(array($this, 'exception_handler'));
    }

    /**
     * Sobrescreve nosso exception para sempre retornar a mensagem que nosso front entende e não um error 500.
     *
     * @param $exception
     */
    public function exception_handler($exception) {
        if(DataBase::isDevMode()){
            $message = new MessageResponse(false, "Erro fatal: '".$exception->getMessage()."'");
        }else{
            $message = new MessageResponse(false, "Aconteceu um erro interno, contate administrador.");
        }
        $this->writeLog($exception);
        echo $message->getJsonFormat();
    }

    public static function writeLog($exception){
        $file = __DIR__.DIRECTORY_SEPARATOR.'logs.txt';
        $number = null;
        $dateTime = new \DateTime();
        $user = BaseController::getUserSessionStatic();
        $message = '---------------- INICIO ---------------- '.PHP_EOL.
                   '   Data/Hora #'.$dateTime->format('d/m/y H:i:s').PHP_EOL.
                   '   Usuário #'.$user[0]['usu_id'].' - '.$user[0]['usu_login'].PHP_EOL.
                   $exception->getMessage()."-".$exception->getTraceAsString().PHP_EOL.
                   '----------------- FIM ------------------';
        $fs = fopen($file, 'a');
        fwrite($fs, $message.PHP_EOL);
        fclose($fs);
    }

}