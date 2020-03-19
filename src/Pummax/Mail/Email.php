<?php


namespace Pummax\Mail;


class Email
{
    protected $host;

    protected $port;

    protected $smtpSecure;

    protected $username;

    protected $senha;

    protected $fromName;

    /**
     * Email constructor.
     * @param $host
     * @param $port
     * @param $username
     * @param $smtpSecure
     * @param $senha
     * @param $fromName
     */
    public function __construct($host, $port, $smtpSecure ,$username, $senha, $fromName)
    {
        $this->host = $host;
        $this->port = $port;
        $this->smtpSecure = $smtpSecure;
        $this->username = $username;
        $this->senha = $senha;
        $this->fromName = $fromName;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param mixed $fromName
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
    }

    /**
     * @return mixed
     */
    public function getSmtpSecure()
    {
        return $this->smtpSecure;
    }

    /**
     * @param mixed $smtpSecure
     */
    public function setSmtpSecure($smtpSecure)
    {
        $this->smtpSecure = $smtpSecure;
    }


}