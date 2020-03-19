<?php


namespace Pummax\Mail;


class MessageEmail
{

    protected $titulo;

    protected $corpo;

    protected $textoCorpo;

    protected $destinatario;

    /**
     * MessageEmail constructor.
     * @param $titulo
     * @param $corpo
     * @param $textoCorpo
     * @param $destinatario
     */
    public function __construct($titulo, $corpo, $destinatario, $textoCorpo = '')
    {
        $this->titulo = $titulo;
        $this->corpo = $corpo;
        $this->textoCorpo = $textoCorpo;
        $this->destinatario = $destinatario;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getCorpo()
    {
        return $this->corpo;
    }

    /**
     * @param mixed $corpo
     */
    public function setCorpo($corpo)
    {
        $this->corpo = $corpo;
    }

    /**
     * @return string
     */
    public function getTextoCorpo()
    {
        return $this->textoCorpo;
    }

    /**
     * @param string $textoCorpo
     */
    public function setTextoCorpo($textoCorpo)
    {
        $this->textoCorpo = $textoCorpo;
    }

    /**
     * @return mixed
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * @param mixed $destinatario
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    }



}