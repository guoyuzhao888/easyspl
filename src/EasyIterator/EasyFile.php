<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/10 下午10:03
 * Description: 对文件的基本操作
 */

namespace EasySpl\EasyIterator;

use EasySpl\EasyTrait\FileIteratorTrait;
use EasySpl\BaseClass\BaseFilterIterator;
use EasySpl\BaseAbstract\BaseAbstract;

Class EasyFile extends BaseAbstract
{
    use FileIteratorTrait;

    protected static $myObject;
    protected $openFile; //打开或者创建的文件
    protected $openFilePath; //打开文件的路径
    protected $delNum = 0; //删除的文件数量
    protected $files = array(); // 查到的所有文件

    /**
     * Description: 获取本类的实例对象
     * User: 郭玉朝
     * CreateTime: 2018/3/15 下午11:22
     * @param $path
     * @return mixed
     */
    public static function instance($path)
    {
        if (is_object(self::$myObject) && $path == self::$dirPath) {
            self::$myObject->initObject($path);
        } else {
            self::$myObject = new EasyFile($path);
        }
        return self::$myObject;
    }

    /**
     * Description: 初始化对象
     * User: 郭玉朝
     * CreateTime: 2018/3/15 下午11:25
     */
    public function initObject($path)
    {
        $this->myBaseFilterIterator = new BaseFilterIterator(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path)));
        $this->openFile = null;
        $this->delNum = 0;
        $this->files = [];
        $this->returnData = [];
        return $this;
    }

    //定义私有的__clone()方法，确保单例类不能被复制或克隆
    private function __clone() {}

    /**
     * Description: 查找目录下的文件是否存在
     * User: 郭玉朝
     * CreateTime: 2018/3/11 上午12:07
     * @param $fileName
     * @return bool
     */
    public function findFiles(string $fileName):object
    {
        foreach (new \RecursiveIteratorIterator($this->myRecursiveDirectoryIterator) as $file)
        {
            if($fileName == $file->getFilename())
            {
                array_push($this->files, $file);
            }
        }
        return $this;
    }

    /**
     * Description: 得到文件的指定信息
     * User: 郭玉朝
     * CreateTime: 2018/3/11 上午12:31
     * @param $funcNames
     * @return array
     */
    public function getFilesInfo(array $funcNames):object
    {
        foreach ($this->files as $file)
        {
            foreach ($funcNames as $funcName)
            {
                $this->returnData[$funcName] = $file->$funcName();
            }
        }
        return $this;
    }

    /**
     * Description: 删除查找出来的文件
     * User: 郭玉朝
     * CreateTime: 2018/3/11 上午1:28
     */
    public function delFiles():int
    {
        foreach ($this->files as $file)
        {
            $this->delNum = unlink($file->getPath()."/".$file->getPathName());
        }
        return $this->delNum;
    }

    /**
     * Description: 用于打开或者创建文件
     * User: 郭玉朝
     * CreateTime: 2018/3/12 上午10:07
     * @param $fileName 需要打开的文件的名字
     * @param $model 文件的打开方式
     * @return $this
     */
    public function openFile(string $fileName, string $model):object
    {
        $this->openFilePath = $this::$dirPath.$fileName;
        $this->openFile = fopen($this->openFilePath, $model) or die("Unable to open file!");
        return $this;
    }

    /**
     * Description: 写入文件
     * User: 郭玉朝
     * CreateTime: 2018/3/12 上午10:15
     * @param $content 写入文件的内容
     */
    public function writeFile(string $content):object
    {
        fwrite($this->openFile,$content);
        return $this;
    }

    /**
     * Description: 用于获取文件的内容
     * User: 郭玉朝
     * CreateTime: 2018/3/12 上午10:22
     * @return bool|string
     */
    public function getFileContent():string
    {
        // 如果只是想将一个文件的内容读入到一个字符串中，请使用 file_get_contents()，它的性能比 fread() 好得多。
        $this->returnData[0] = file_get_contents($this->openFilePath);
        return $this->returnData[0];
    }

    /**
     * Description: 用于查找文件的内容是否存在
     * User: 郭玉朝
     * CreateTime: 2018/3/12 上午11:10
     * @param $content
     * @return bool
     */
    public function findFileContent($content):bool
    {
        return strstr(file_get_contents($this->openFilePath),$content);
    }


    /**
     * Description: 通过扩展名查找文件
     * User: 郭玉朝
     * CreateTime: 2018/3/15 下午10:34
     * @param array $fileExt
     * @return $this
     */
    public function adoptExt(array $fileExt)
    {
        $this->myBaseFilterIterator->fileExt = $fileExt;
        foreach ($this->myBaseFilterIterator as $item)
        {
            array_push($this->returnData, $item->getPathName());
        }
        return $this;
    }

    public function __destruct()
    {
        if(strlen($this->openFile) > 0)
        {
            fclose($this->openFile);
        }
    }
}