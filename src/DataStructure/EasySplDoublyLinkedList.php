<?php
namespace EasySpl\DataStructure;
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/7 下午6:11
 * Description:
 */
class EasySplDoublyLinkedList extends \SplDoublyLinkedList
{
    protected $allPoint;
    /**
     * Description: 支持数组方式push
     * User: 郭玉朝
     * CreateTime: 2018/3/7 下午9:20
     * @param mixed $values
     * @return $this|void
     */
    public function push($values):void
    {
        if (is_array($values)){
            foreach ($values as $value)
            {
                parent::push($value);
            }
        } else {
            parent::push($values);
        }
    }

    /**
     * Description: 获取所有节点的值
     * User: 郭玉朝
     * CreateTime: 2018/3/8 下午4:17
     * @return mixed
     */
    public function getValues():array
    {
        $this->rewind();
        while ($this->valid()){
            $this->allPoint[$this->key()] = $this->current();
            $this->next();
        }
        return $this->allPoint;
    }

    /**
     * Description: 设置迭代模式
     * User: 郭玉朝
     * CreateTime: 2018/3/8 下午5:44
     * @param int $data
     */
    public function setIteratorMode($data):void
    {
        $mode = null;
        switch ($data)
        {
            case 'LIFO_DELETE':
                $mode = $this::IT_MODE_LIFO | $this::IT_MODE_DELETE;
                break;
            case 'FIFO_DELETE':
                $mode = $this::IT_MODE_FIFO | $this::IT_MODE_DELETE;
                break;
            case 'LIFO_KEEP':
                $mode = $this::IT_MODE_LIFO | $this::IT_MODE_KEEP;
                break;
        }
        parent::setIteratorMode($mode);
    }
}