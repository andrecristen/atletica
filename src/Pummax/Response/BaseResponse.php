<?php


namespace Pummax\Response;


abstract class BaseResponse
{
    const TYPE_GRID = 'grid';
    const TYPE_MESSAGE = 'message';
    const TYPE_FROM = 'form';
    const TYPE_API = 'api';

    protected $type;

    abstract public function getJsonFormat();

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}