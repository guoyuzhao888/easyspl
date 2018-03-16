<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/16 上午8:32
 * Description:
 */
namespace EasySpl\BaseAbstract;
abstract class BaseAbstract
{
    protected $returnData = []; //返回信息

    /**
     * Description: 初始化对象，单例模式返回对象
     * User: 郭玉朝
     * CreateTime: 2018/3/16 上午9:03
     * @param $data
     * @return mixed
     */
    public abstract static function instance($data);

    /**
     * Description: 初始化对象属性
     * User: 郭玉朝
     * CreateTime: 2018/3/16 上午9:04
     * @param $data
     * @return mixed
     */
    public abstract function initObject($data);

    /**
     * Description: 返回文件信息
     * User: 郭玉朝
     * CreateTime: 2018/3/11 上午12:48
     * @return array
     */
    public function toArray()
    {
        if(empty($this->returnData))
        {
            return array();
        }
        return $this->returnData;
    }

}