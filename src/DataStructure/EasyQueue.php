<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/9 下午4:41
 * Description: 队列
 */
namespace EasySpl\DataStructure;

use EasySpl\EasyTrait\DataStructureTrait;
class EasyQueue extends \SplQueue
{
    use DataStructureTrait;

    /**
     * Description: 改造压入队列使其支持数组方式进队列
     * User: 郭玉朝
     * CreateTime: 2018/3/9 下午5:14
     * @param mixed $value
     */
    public function enqueue($value)
    {
        $this->arraySupport($value,__FUNCTION__);
    }

    /**
     * Description: 改造弹出队列使其支持数组方式弹出队列
     * User: 郭玉朝
     * CreateTime: 2018/3/9 下午5:14
     * @param mixed $value
     */
    public function unenqueue($value)
    {
        $this->arraySupport($value,__FUNCTION__);
    }
}