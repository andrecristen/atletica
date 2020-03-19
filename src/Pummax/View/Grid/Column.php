<?php


namespace Pummax\View\Grid;


use Pummax\Util\StringUtil;

class Column implements IColumnType
{

    protected $title;

    protected $content;

    protected $visible;

    protected $width;

    protected $tableName;

    protected $type;

    protected $list;

    /**
     * Column constructor.
     * @param $title
     * @param $content
     * @param $type
     * @param $modelName
     * @param $visible
     * @param $width
     */
    public function __construct($title, $content, $type, $modelName, $visible = true, $width = 'auto')
    {
        $modelName = StringUtil::toModelName($modelName);
        $this->title = $title;
        $this->content = $content;
        $this->type = $type;
        $this->tableName = $modelName;
        $this->visible = $visible;
        $this->width = $width;
        if($type == self::TYPE_BOOLEAN){
            $this->list = ['true' => 'Sim', 'false' => 'Não'];
        }
    }

    public function getArrayFormat()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'tableName' => $this->tableName,
            'visible' => $this->visible,
            'type' => $this->type,
            'list' => $this->list,
            'operadores' => $this->getOperatorList($this->type),
            'width' => $this->width,
        ];
    }

    public function getOperatorList($type)
    {
        $list = [];
        switch ($type) {
            case self::TYPE_TEXT:
                $list[] = [
                    'operador' => '=',
                    'title' => 'Igual'
                ];
                $list[] = [
                    'operador' => '<>',
                    'title' => 'Diferente'
                ];
                $list[] = [
                    'operador' => 'like',
                    'title' => 'Contém'
                ];
                $list[] = [
                    'operador' => 'not like',
                    'title' => 'Não Contém'
                ];
                break;
            case self::TYPE_NUMBER:
                $list[] = [
                    'operador' => '=',
                    'title' => 'Igual'
                ];
                $list[] = [
                    'operador' => '>',
                    'title' => 'Maior'
                ];
                $list[] = [
                    'operador' => '>=',
                    'title' => 'Maior Igual'
                ];
                $list[] = [
                    'operador' => '<',
                    'title' => 'Menor'
                ];
                $list[] = [
                    'operador' => '<=',
                    'title' => 'Menor Igual'
                ];
                $list[] = [
                    'operador' => '<>',
                    'title' => 'Diferente'
                ];
                break;
            case self::TYPE_DATE:
            case self::TYPE_DATE_TIME:
            case self::TYPE_BOOLEAN:
            case self::TYPE_LIST:
                $list[] = [
                    'operador' => '=',
                    'title' => 'Igual'
                ];
                $list[] = [
                    'operador' => '<>',
                    'title' => 'Diferente'
                ];
                break;
        }
        return $list;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param bool $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

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

    /**
     * @return mixed
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param mixed $list
     */
    public function setList($list)
    {
        $this->list = $list;
    }


}