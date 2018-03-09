<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/9 下午4:25
 * Description: 改造方法
 */
namespace EasySpl\EasyTrait;
trait DataStructureTrait
{
    protected $allPoint;

    /**
     * Description: 支持数组方式
     * User: 郭玉朝
     * CreateTime: 2018/3/7 下午9:20
     * @param mixed $values
     * @return $this|void
     */
    public function arraySupport($values,$funcName):void
    {
        if (is_array($values)){
            foreach ($values as $value)
            {
                parent::$funcName($value);
            }
        } else {
            parent::$funcName($values);
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
}