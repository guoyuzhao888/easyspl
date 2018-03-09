<?php
namespace EasySpl\DataStructure;

use EasySpl\EasyTrait\DataStructureTrait;
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/7 下午6:11
 * Description: 双向链表
 */
class EasyDoublyLinkedList extends \SplDoublyLinkedList
{
    use DataStructureTrait;
    protected $selfSerialize;

    public function push($value)
    {
        $this->arraySupport($value,__FUNCTION__);
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