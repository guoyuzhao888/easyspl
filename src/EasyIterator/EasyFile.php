<?php
/**
 * User: 郭玉朝
 * CreateTime: 2018/3/10 下午10:03
 * Description:
 */

namespace EasySpl\EasyIterator;

use EasySpl\EasyTrait\FileIteratorTrait;

Class EasyFile
{
    use FileIteratorTrait;

    protected $openFile; //打开或者创建的文件
    protected $openFilePath; //打开文件的路径
    protected $fileContent; //存放文件的内容
    protected $delNum = 0; //删除的文件数量
    protected $files = array(); // 查到的所有文件
    protected $filesInfo = array(); //查到的所有文件的信息

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
                $this->filesInfo[$funcName] = $file->$funcName();
            }
        }
        return $this;
    }

    /**
     * Description: 返回文件信息
     * User: 郭玉朝
     * CreateTime: 2018/3/11 上午12:48
     * @return array
     */
    public function toArray():array
    {
        if(empty($this->filesInfo))
        {
            return array();
        }
        return $this->filesInfo;
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
        $this->openFilePath = $this->dirPath.$fileName;
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
        $this->fileContent = file_get_contents($this->openFilePath);
        return $this->fileContent;
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

    public function __destruct()
    {
        if(strlen($this->openFile) > 0)
        {
            fclose($this->openFile);
        }
    }
}