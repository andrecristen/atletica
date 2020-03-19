<?php


namespace Pummax\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use Pummax\Handler\HandlerException;

class SendEmail
{

    public function send(Email $emailRemetente, MessageEmail $email){
        try{
            $mailer = new PHPMailer();
            //Define que será usado SMTP
            $mailer->IsSMTP();
            //Enviar e-mail em HTML
            $mailer->isHTML(true);
            //Aceitar carasteres especiais
            $mailer->Charset = 'UTF-8';
            //Configurações
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = $emailRemetente->getSmtpSecure();
            //nome do servidor
            $mailer->Host = $emailRemetente->getHost();
            //Porta de saida de e-mail
            $mailer->Port = $emailRemetente->getPort();
            //Dados do e-mail de saida - autenticação
            $mailer->Username = $emailRemetente->getUsername();
            $mailer->Password = $emailRemetente->getSenha();
            //E-mail remetente (deve ser o mesmo de quem fez a autenticação)
            $mailer->From = $emailRemetente->getUsername();
            //Nome do Remetente
            $mailer->FromName = $emailRemetente->getFromName();
            //Assunto da mensagem
            $mailer->Subject = $email->getTitulo();
            //Corpo da Mensagem
            $mailer->Body = $email->getCorpo();
            //Corpo da mensagem em texto
            $mailer->AltBody = $email->getTextoCorpo();
            //Destinatario
            $mailer->AddAddress($email->getDestinatario());
            if(!$mailer->Send()){
               throw new \Exception("Erro no envio do e-mail: " . $mailer->ErrorInfo);
            }
        }catch (\Exception $exception){
            HandlerException::writeLog($exception);
        }
    }

}