<?php


namespace Pummax\View\Grid;


use Pummax\Interfaces\IArrayFormat;

class Action implements IArrayFormat
{

    protected $title;

    protected $class;

    protected $icon;

    protected $router;

    protected $isRow;


    /**
     * Action constructor.
     * @param $title
     * @param $class
     * @param $icon
     * @param $router
     * @param $isRow
     */
    public function __construct($title, $router, $icon = '', $class = 'btn-primary', $isRow = false)
    {
        $this->title = $title;
        $this->router = $router;
        $this->isRow = $isRow;
        $this->class = 'btn btn-sm '.$class;
        $this->icon = $icon;

    }

    public function getArrayFormat()
    {
        return [
            'title' => $this->title,
            'router' => $this->router,
            'isRow' => $this->isRow,
            'class' => $this->class,
            'icon' => $this->icon,
        ];
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param mixed $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }


}