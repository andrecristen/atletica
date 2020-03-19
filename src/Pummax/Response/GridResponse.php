<?php


namespace Pummax\Response;


use Pummax\Controller\BaseGridController;
use Pummax\Util\Json;
use Pummax\View\Grid\AbstractGrid;

class GridResponse extends BaseResponse
{
    protected $fields;
    protected $data;
    protected $count;

    /**
     * GridResponse constructor.
     * @param $view
     * @param $data
     * @param $count
     */
    public function __construct(AbstractGrid $view, $data, $count)
    {
        $this->fields = $view->getArrayFormat();
        $this->data = $data;
        $this->count = $count;
        $this->type = self::TYPE_GRID;
    }

    public function getJsonFormat()
    {
        $pages = ceil($this->getCount() / BaseGridController::PAGE_LIMIT);
        return Json::encode([
          'data' => $this->getData(),
          'fields' => $this->getFields(),
          'count' => $this->getCount(),
          'pages' => $pages ? $pages : 1,
          'type' => $this->getType(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

}