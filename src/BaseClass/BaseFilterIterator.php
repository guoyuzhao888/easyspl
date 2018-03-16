<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/15 下午10:40
 * Description:
 */
namespace EasySpl\BaseClass;
use Iterator;

class BaseFilterIterator extends \FilterIterator
{
    public $fileExt = []; // 通过扩展名查找文件

    public function __construct(Iterator $iterator)
    {
        parent::__construct($iterator);
    }

    /**
     * Description: 重写继承的方法
     * User: 郭玉朝
     * CreateTime: 2018/3/15 下午10:34
     * @return bool
     */
    public function accept()
    {
        if ($this->isFile() && in_array(pathinfo($this->getFilename(), PATHINFO_EXTENSION), $this->fileExt)) {
            return true;
        }
    }
}